<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\BusSchedule;
use App\Models\BusTicket;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function myTiket()
    {
        $tickets = BusTicket::where('user_id', auth()->id())->latest()->paginate(4);
        return view('users.my-tiket', compact('tickets'));
    }
    public function order($order)
    {
        $orderArr = base64_decode($order);
        $orderArr = explode('|', $orderArr);
        if (count($orderArr) != 3) {
            return abort(404, 'Order invalid');
        }

        $bus_id = $orderArr[0];
        $date = $orderArr[1];
        $schedule_id = $orderArr[2];

        $bus = Bus::find($bus_id);
        if (!$bus) {
            return abort(404, 'Bus not found');
        }

        $schedule = BusSchedule::find($schedule_id);
        if (!$schedule) {
            return abort(404, 'Schedule not found');
        }

        $bus->seats = $bus->getSeats($date, $schedule_id);

        return view('users.order', compact('bus', 'date', 'schedule'));
    }

    public function printTicket(BusTicket $ticket)
    {
        $logo = base64_encode(file_get_contents(public_path('logo.png')));
        $pdf = Pdf::loadView('users.print-ticket', compact('ticket','logo'));
        $pdf->setPaper('a5', 'landscape');
        return $pdf->stream();
    }

    public function verifyTicket(BusTicket $ticket)
    {
        if (!(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))) {
            return abort(403, 'Unauthorized');
        }
        if ($ticket->departure_time->format('Y-m-d') == now()->format('Y-m-d') && $ticket->status == 'pending') {
            $ticket->update([
                'status' => 'approved'
            ]);
            $logo = base64_encode(file_get_contents(public_path('logo.png')));
            $pdf = Pdf::loadView('users.print-ticket', compact('ticket','logo'));
            $pdf->setPaper('a5', 'landscape');
            return $pdf->stream();
        }else{
            return abort(403, "Tiket Kadaluwarsa");
        }
       
    }
}

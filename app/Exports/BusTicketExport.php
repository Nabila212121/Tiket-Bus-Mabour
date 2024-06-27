<?php

namespace App\Exports;

use App\Models\BusTicket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BusTicketExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        if ($this->data['format'] == 'bulan') {
            $bulan = $this->data['bulan'];
            $tahun = $this->data['tahun'];
            return BusTicket::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get();
        }
        if ($this->data['format'] == 'tahun') {
            $tahun = $this->data['tahun'];
            return BusTicket::whereYear('created_at', $tahun)->get();
        }
        if ($this->data['format'] == 'range') {
            $start = $this->data['start_date'];
            $end = $this->data['end_date'];
            return BusTicket::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
        }
        return BusTicket::all();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Pemesan',
            'Penumpang',
            'Bus',
            'Nomor Kursi',
            'Kloter',
            'Waktu Keberangkatan',
            'Tanggal Pemesanan',
        ];
    }

    public function map($ticket): array
    {
        return [
            $ticket->order_id,
            $ticket->user->name,
            $ticket->customer_name,
            $ticket->bus->name,
            $ticket->seat_number,
            $ticket->busSchedule->name,
            $ticket->departure_time,
            $ticket->created_at,
        ];
    }


}

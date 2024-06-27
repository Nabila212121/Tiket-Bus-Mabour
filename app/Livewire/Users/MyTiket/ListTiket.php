<?php

namespace App\Livewire\Users\MyTiket;

use App\Mail\SendEmail;
use App\Models\BusTicket;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ListTiket extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?array $data = [];

    public $tickets = [];


    public function mount($tickets)
    {
        $this->tickets = $tickets;
        $this->form->fill($this->data);
    }

    public function cetakTiket(): Action
    {
        return Action::make('cetakTiket')
            ->label('Cetak')
            ->color('info')
            ->requiresConfirmation()
            ->action(function (array $arguments) {
                return redirect('/my-tiket/' . $arguments['id']);
            });
    }

    public function batalkanTiket(): Action
    {
        return Action::make('batalkanTiket')
            ->label('Batal')
            ->color('danger')
            ->requiresConfirmation()
            ->action(function (array $arguments) {
                $ticket = BusTicket::find($arguments['id']);
                $ticket->update([
                    'status' => 'canceled'
                ]);
                $logo = base64_encode(file_get_contents(public_path('logo.png')));
                $pdf = Pdf::loadView('users.print-ticket', compact('ticket', 'logo'));
                $pdf->setPaper('a5', 'landscape');
                Mail::to(auth()->user()->email)->send(new SendEmail($pdf->output(), 'Pembatalan Tiket Bus Mabour', 'Tiket bus anda telah dibatalkan. Terima kasih telah menggunakan layanan kami.'));
            });
    }

    public function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public function render()
    {
        return view('livewire.users.my-tiket.list-tiket');
    }
}

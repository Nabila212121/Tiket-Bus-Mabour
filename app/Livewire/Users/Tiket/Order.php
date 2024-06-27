<?php

namespace App\Livewire\Users\Tiket;

use App\Forms\Components\SeatPicker;
use App\Mail\SendEmail;
use App\Models\BusTicket;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;
use Livewire\Component;
use Nette\Utils\Html;

class Order extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $bus;

    public $date;

    public $schedule;

    public $selectedSeats;

    public $usedSeats = [];

    public $bookedSeats;

    public $availableSeats = [];



    public function mount($bus, $date, $schedule)
    {
        $this->bus = $bus;
        $this->usedSeats = $bus->seats['used'];
        $this->availableSeats = $bus->seats['available'];
        $this->data['bus'] = $bus->toArray();
        $this->date = Carbon::parse($date)->format('Y-m-d');
        $this->schedule = $schedule;
        $this->data['date'] = Carbon::parse($date)->format('d/m/Y');
        $this->data['schedule'] = $schedule->toArray();
        $this->form->fill($this->data);
        $this->bookedSeats = BusTicket::where('user_id', auth()->id())->where('bus_schedule_id', $schedule->id)->whereDate('departure_time', Carbon::now('Asia/Jakarta')->format('Y-m-d'))->count();
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Section::make('Keterangan Tiket')->schema([
                    Forms\Components\Section::make(function () {
                        return 'Informasi Bus (' . $this->bus->name . ')';
                    })->schema([
                        Forms\Components\TextInput::make('bus.name')->label('Nama Bus')->disabled(),
                        Forms\Components\TextInput::make('bus.license_plate')->label('Nomor Plat')->disabled(),
                        Forms\Components\TextInput::make('bus.capacity')->label('Kapasitas')->disabled(),
                    ])->collapsible()->collapsed(true),
                    Forms\Components\Section::make(function () {
                        return 'Informasi Jadwal (' . $this->schedule->name . ')';
                    })->schema([
                        Forms\Components\TextInput::make('schedule.name')->label('Nama Jadwal')->disabled(),
                        Forms\Components\TextInput::make('schedule.departure_time')->label('Jam Berangkat')->disabled(),
                        Forms\Components\TextInput::make('date')->label('Tanggal')->disabled(),
                    ])->collapsible()->collapsed(true),
                ])->columnSpan(1),
                Forms\Components\Section::make('Pilih Kursi')->schema([

                    Checkbox::make('seat_number.1')->live()->disabled(function () {
                        return in_array(1, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 1);
                    }),
                    Checkbox::make('seat_number.2')->live()->disabled(function () {
                        return in_array(2, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 2);
                    }),
                    Group::make(),
                    Group::make([
                        Placeholder::make('')->content(new HtmlString(
                            '
                            <div class="text-center bg-gray-400">
                                <h1 class="text-xl font-bold">Supir</h1>
                            </div>
                            '
                        ))->columnSpanFull()
                    ])->columnSpan(2),
                    Checkbox::make('seat_number.3')->live()->disabled(function () {
                        return in_array(3, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 3);
                    }),
                    Checkbox::make('seat_number.4')->live()->disabled(function () {
                        return in_array(4, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 4);
                    }),
                    Group::make(),
                    Checkbox::make('seat_number.5')->live()->disabled(function () {
                        return in_array(5, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 5);
                    }),
                    Checkbox::make('seat_number.6')->live()->disabled(function () {
                        return in_array(6, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 6);
                    }),
                    Checkbox::make('seat_number.7')->live()->disabled(function () {
                        return in_array(7, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 7);
                    }),
                    Checkbox::make('seat_number.8')->live()->disabled(function () {
                        return in_array(8, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 8);
                    }),
                    Group::make(),
                    Checkbox::make('seat_number.9')->live()->disabled(function () {
                        return in_array(9, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 9);
                    }),
                    Checkbox::make('seat_number.10')->live()->disabled(function () {
                        return in_array(10, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 10);
                    }),
                    Checkbox::make('seat_number.11')->live()->disabled(function () {
                        return in_array(11, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 11);
                    }),
                    Checkbox::make('seat_number.12')->live()->disabled(function () {
                        return in_array(12, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 12);
                    }),
                    Group::make(),
                    Checkbox::make('seat_number.13')->live()->disabled(function () {
                        return in_array(13, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 13);
                    }),
                    Checkbox::make('seat_number.14')->live()->disabled(function () {
                        return in_array(14, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 14);
                    }),
                    Checkbox::make('seat_number.15')->live()->disabled(function () {
                        return in_array(15, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 15);
                    }),
                    Checkbox::make('seat_number.16')->live()->disabled(function () {
                        return in_array(16, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 16);
                    }),
                    Group::make(),
                    Checkbox::make('seat_number.17')->live()->disabled(function () {
                        return in_array(17, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 17);
                    }),
                    Checkbox::make('seat_number.18')->live()->disabled(function () {
                        return in_array(18, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 18);
                    }),
                    Checkbox::make('seat_number.19')->live()->disabled(function () {
                        return in_array(19, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 19);
                    }),
                    Checkbox::make('seat_number.20')->live()->disabled(function () {
                        return in_array(20, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 20);
                    }),
                    Group::make(),
                    Checkbox::make('seat_number.21')->live()->disabled(function () {
                        return in_array(21, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 21);
                    }),
                    Checkbox::make('seat_number.22')->live()->disabled(function () {
                        return in_array(22, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 22);
                    }),
                    Checkbox::make('seat_number.23')->live()->disabled(function () {
                        return in_array(23, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 23);
                    }),
                    Checkbox::make('seat_number.24')->live()->disabled(function () {
                        return in_array(24, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 24);
                    }),
                    Group::make(),
                    Checkbox::make('seat_number.25')->live()->disabled(function () {
                        return in_array(25, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 25);
                    }),
                    Checkbox::make('seat_number.26')->live()->disabled(function () {
                        return in_array(26, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 26);
                    }),
                    Checkbox::make('seat_number.27')->live()->disabled(function () {
                        return in_array(27, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 27);
                    }),
                    Checkbox::make('seat_number.28')->live()->disabled(function () {
                        return in_array(28, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 28);
                    }),
                    Group::make(),
                    Checkbox::make('seat_number.29')->live()->disabled(function () {
                        return in_array(29, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 29);
                    }),
                    Checkbox::make('seat_number.30')->live()->disabled(function () {
                        return in_array(30, $this->usedSeats);
                    })->afterStateUpdated(function ($set, $get) {

                        $this->updatedSelectedSeats($set, $get, 30);
                    }),

                ])->columns([
                    'default' => 5,
                    'sm' => 5,
                    'md' => 5,
                    'lg' => 5,
                    'xl' => 5,
                ])->columnSpan(1),
                Forms\Components\Section::make('Informasi Order')->schema([
                    Placeholder::make('')->content(function ($get) {
                        if (array_search(true, $get('seat_number') ?? []) !== false) {
                            return 'Setelah memilih kursi, silahkan isi nama dan klik tombol "Buat Reservasi" untuk melanjutkan.';
                        } else {
                            return 'Silahkan pilih kursi terlebih dahulu.';
                        }
                    }),
                    Forms\Components\Section::make('')
                        ->compact()
                        ->columns(2)
                        ->schema(function ($get) {
                            $seats = [];
                            for ($i = 1; $i <= sizeof($get('seat_number') ?? []); $i++) {
                                if ($get('seat_number.' . $i) == true) {
                                    $seats[] = TextInput::make('customer_name.' . $i)->label('Nama Kursi ' . $i)->placeholder('Nama Penumpang ' . $i)->required();
                                }
                            }

                            return $seats;
                        }),
                    Actions::make([
                        Action::make('create')->label('Buat Reservasi')->requiresConfirmation()->action(function () {
                            $this->create();
                        })->modalDescription(function ($get) {
                            $selecteds = [];
                            foreach ($this->selectedSeats as $key => $value) {
                                if ($value == true) {
                                    $selecteds[] = $key;
                                }
                            }
                            return new HtmlString('Apakah anda yakin ingin membuat reservasi untuk nomor kursi ' . implode(', ', $selecteds) . ' pada tanggal ' . $get('date') . ' jam ' . $get('schedule.departure_time') . ' WIB?');
                        }),
                    ])
                        ->visible(function ($get) {
                            return array_search(true, $get('seat_number') ?? []) !== false;
                        })
                ])->columnSpan(1)
            ])
            ->statePath('data');
    }

    public function updatedSelectedSeats($set, $get, $index)
    {
        $count = 0;
        for ($i = 1; $i <= sizeof($get('seat_number') ?? []); $i++) {
            if ($get('seat_number.' . $i) == true) {
                $this->selectedSeats[$i] = true;
                $count++;
            } else {
                $this->selectedSeats[$i] = false;
            }
        }
        if ($count > (5 - $this->bookedSeats)) {
            $set('seat_number.' . $index, false);
            Notification::make('error')->title('Gagal')->body('Maksimal 5 kursi untuk satu hari')->danger()->send();
            return;
        }
    }

    public function create()
    {
        if (auth()->user() == null) {
            return redirect()->route('login');
        }
        $data = $this->form->getState();
        if ($this->selectedSeats == null) {
            Notification::make('error')->title('Gagal')->body('Silahkan pilih kursi terlebih dahulu')->danger()->send();
            return;
        }

        $selecteds = [];
        foreach ($this->selectedSeats as $key => $value) {
            if ($value == true) {
                $selecteds[] = $key;
            }
        }
        $this->selectedSeats = $selecteds;

        $seats = $this->bus->getSeats($this->date, $this->schedule->id);
        $this->usedSeats = $seats['used'];

        foreach ($this->selectedSeats as $selected) {
            if (in_array($selected, $seats['used'])) {
                Notification::make('error')->title('Gagal Memesan Kursi' . $selected)->body('Kursi ' . $selected . ' sudah terisi')->danger()->send();
            } else {
                DB::beginTransaction();
                try {
                    $ticket = BusTicket::create([
                        'bus_schedule_id' => $this->schedule->id,
                        'seat_number' => $selected,
                        'bus_id' => $this->bus->id,
                        'customer_name' => $data['customer_name'][$selected],
                        'departure_time' => Carbon::parse($this->date . ' ' . $this->schedule->departure_time)->format('Y-m-d H:i:s'),
                        'user_id' => auth()->id(),
                    ]);
                    $logo = base64_encode(file_get_contents(public_path('logo.png')));
                    $pdf = Pdf::loadView('users.print-ticket', compact('ticket', 'logo'));
                    $pdf->setPaper('a5', 'landscape');
                    Mail::to(auth()->user()->email)->send(new SendEmail($pdf->output(), 'Pemesanan Tiket Bus Mabour', 'Terima kasih telah memesan tiket. Berikut adalah tiket anda.'));
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }

        Notification::make('success')->title('Berhasil')->body('Reservasi berhasil dibuat')->success()->send();
        return redirect()->route('my-tiket');
    }

    public function render()
    {
        return view('livewire.users.tiket.order');
    }
}

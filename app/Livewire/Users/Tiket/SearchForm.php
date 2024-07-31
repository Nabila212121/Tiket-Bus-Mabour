<?php

namespace App\Livewire\Users\Tiket;

use App\Models\Bus;
use App\Models\BusSchedule;
use Carbon\Carbon;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class SearchForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $showData = false;

    public $bus = [];

    public $date;

    public $bus_schedule_id;

    public function mount(): void
    {
        $this->date = now();
        $this->form->fill();
    }

    public function showReservation(){
        $date = now();
        $dayOfWeek = $date->format('l'); // Mengambil nama hari dalam bahasa Inggris
    
        if ($dayOfWeek == 'Wednesday' || $dayOfWeek == 'Thursday') {
            return true;
        } else {
            return false;
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    // DatePicker::make('date')
                    //     ->label('Pilih Tanggal')
                    //     ->native(false)
                    //     ->closeOnDateSelection()
                    //     ->live()
                    //     ->afterStateUpdated(function($set){
                    //         $set('bus_schedule_id', null);
                    //     })
                    //     ->minDate(Carbon::parse(now()->format('Y-m-d') . ' 00:00:00'))
                    //     ->maxDate(now()->addDays(7)),

                    Select::make('bus_schedule_id')
                        ->label('Pilih Jadwal')
                        ->native(false)
                        ->visible($this->showReservation())
                        ->searchable()
                        ->options(function () {
                            $date = now()->format('Y-m-d');
                            $schedule = null;
                            $date = Carbon::parse($date)->format('Y-m-d');
                            if (now('Asia/Jakarta')->format('Y-m-d') == $date) {
                                $schedule = BusSchedule::where('active', true)->where('departure_time', '>', now('Asia/Jakarta')->format('H:i:s'))->get();
                            } else {
                                $schedule = BusSchedule::where('active', true)->get();
                            }
                            $data = [];
                            foreach ($schedule as $item) {
                                $data[$item->id] = $item->name . ' (' . $item->departure_time .')';
                            }
                            return $data;
                        }),

                    Actions::make([
                        Action::make('search')->label('Cari')->icon('heroicon-o-magnifying-glass-circle')->submit('create')
                    ])
                    ->visible($this->showReservation()),

                    Placeholder::make('reservasi')
                    ->label('')
                    ->content('Tidak ada reservasi hari ini')
                    ->visible(!$this->showReservation())
                ])
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $date = $this->date->format('Y-m-d');
       if ($data['bus_schedule_id'] == null) { //validasi data apakah jadwal bus sudah dipilih oleh pengguna
            Notification::make()->title('Peringatan')->body('Jadwal tidak boleh kosong')->danger()->send();
        } else {
            $bus = Bus::whereHas('busSchedules', function ($query) use ($data) {
                $query->where('bus_schedule_id', $data['bus_schedule_id']);
            })->where('active', true)->get(); //Mengambil data bus yang memiliki jadwal sesuai yg dipilih

            //Memproses bus yang ditemukan dan menghitung kursi yang tersedia
            $bus = $bus->map(function ($item) use ($data, $date) {
                $item->seats = $item->getSeats($date, $data['bus_schedule_id']);
                return $item;
            });

            $this->bus_schedule_id = $data['bus_schedule_id'];
            $this->bus = $bus;
            $this->showData = true;
        }
    }

    public function closeShowData()
    {
        $this->bus = [];
        $this->showData = false;
    }

    public function render()
    {
        return view('livewire.users.tiket.search-form');
    }
}

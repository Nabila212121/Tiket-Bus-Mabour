<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusTicketResource\Pages;
use App\Filament\Resources\BusTicketResource\RelationManagers;
use App\Models\BusTicket;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class BusTicketResource extends Resource
{
    protected static ?string $model = BusTicket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Bus';

    //sort
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(function ($record) {
                    if ($record == null) {
                        return 'Pemesanan Tiket Bus';
                    }
                    return 'Informasi Order ' . $record->order_id;
                })
                    ->columns()
                    ->schema([
                        Forms\Components\Select::make('bus_id')
                            ->label('Bus')
                            ->native(false)
                            ->searchable()
                            ->live()
                            ->options(fn () => \App\Models\Bus::all()->pluck('name', 'id'))
                            ->required(),
                        Forms\Components\Select::make('bus_schedule_id')
                            ->label('Kloter')
                            ->searchable()
                            ->native(false)
                            ->live()
                            ->options(function () {
                                $schedules = \App\Models\BusSchedule::all();
                                $schedules = $schedules->map(function ($item) {
                                    $item->name = $item->name . ' (' . $item->departure_time  . ')';
                                    return $item;
                                });
                                return $schedules->pluck('name', 'id');
                            })
                            ->required(),

                        Forms\Components\DatePicker::make('departure_time')
                            ->label('Waktu Keberangkatan')
                            ->live()
                            ->required(),
                        Forms\Components\Select::make('seat_number')
                            ->label('Nomor Kursi')
                            ->hint(function ($get) {
                                if ($get('bus_id') == null || $get('bus_schedule_id') == null) {
                                    return 'Pilih bus dan kloter terlebih dahulu untuk melihat kursi yang tersedia';
                                }
                            })
                            ->live()
                            ->visible(fn ($get) => $get('bus_id') != null && $get('bus_schedule_id') != null && $get('departure_time'))
                            ->options(function ($get) {
                                $schedules = \App\Models\BusSchedule::find($get('bus_schedule_id'));
                                $bus = \App\Models\Bus::find($get('bus_id'));
                                if ($schedules && $bus) {
                                    $available =  $bus->getSeats($get('departure_time'), $get('bus_schedule_id'))['available'];
                                    $result = [];
                                    foreach ($available as  $value) {
                                        $result[$value] = $value;
                                    }
                                    return $result;
                                }
                                return [];
                            })
                            ->native(false)
                            ->required(),
                        Forms\Components\TextInput::make('customer_name'),
                        Forms\Components\Select::make('user_id')
                            ->label('User')
                            ->native(false)
                            ->searchable()
                            ->default(Auth::user()->id)
                            ->options(fn () => \App\Models\User::all()->pluck('name', 'id'))
                            ->required()
                            ->suffixAction(
                                Action::make('tambah_user')
                                    ->label('Tambah User')
                                    ->form(function ($form) {
                                        return UserResource::form($form);
                                    })
                                    ->icon('heroicon-o-plus')
                                    ->action(function ($data) {
                                        $user = \App\Models\User::create($data);
                                        $user->assignRole('user');
                                        Notification::make()->title('Berhasil')->body('User berhasil ditambahkan')->success()->send();
                                        return $user;
                                    })
                            ),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('departure_time', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('qr_image')
                    ->label('QR Code'),
                Tables\Columns\TextColumn::make('order_id')
                    ->label('Order ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemesan')
                    ->sortable(),
                    Tables\Columns\TextColumn::make('customer_name')
                    ->label('Penumpang')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bus.name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('seat_number')
                    ->label('Kursi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('departure_time')
                    ->label('Keberangkatan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_text')
                    ->badge()
                    ->label('Status')
                    ->color(fn ($state) => match ($state) {
                        'Menunggu Keberangkatan' => 'warning',
                        'Besok' => 'success',
                        'Hari Ini' => 'success',
                        'Diberangkatkan' => 'success',
                        'Dibatalkan' => 'danger',
                        'Kadaluwarsa' => 'danger',
                    })
                    ->searchable(),
                
                    Tables\Columns\TextColumn::make('created_at')
                    ->label('Dipesan pada')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('updated_at')
                    ->label('Teraakhir diubah')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusTickets::route('/'),
            'create' => Pages\CreateBusTicket::route('/create'),
            'edit' => Pages\EditBusTicket::route('/{record}/edit'),
        ];
    }
}

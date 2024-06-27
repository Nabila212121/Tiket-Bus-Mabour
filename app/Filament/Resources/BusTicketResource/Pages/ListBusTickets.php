<?php

namespace App\Filament\Resources\BusTicketResource\Pages;

use App\Exports\BusTicketExport;
use App\Filament\Resources\BusTicketResource;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListBusTickets extends ListRecords
{
    protected static string $resource = BusTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Tiket')
                ->icon('heroicon-o-plus-circle'),
            Actions\Action::make('download')
                ->label('Download Laporan')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->form(function ($form) {
                    return $form
                    ->schema([
                        Select::make('format')
                            ->label('Format Laporan')
                            ->required()
                            ->options([
                                'bulan' => 'Bulan',
                                'tahun' => 'Tahun',
                                'range' => 'Range Tanggal'
                            ])
                            ->native(false)
                            ->live(),

                        Group::make([
                            Select::make('bulan')
                                ->required()
                                ->options([
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Maret',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Juni',
                                    '07' => 'Juli',
                                    '08' => 'Agustus',
                                    '09' => 'September',
                                    '10' => 'Oktober',
                                    '11' => 'November',
                                    '12' => 'Desember'
                                ])->native(false),
                            Select::make('tahun')
                                ->required()
                                ->options(
                                    
                                function(){
                                    $tahun = range(date('Y'), 2023);
                                    $result = [];
                                    foreach ($tahun as  $value) {
                                        $result[$value] = $value;
                                    }
                                    return $result;
                                }
                                )->native(false),

                        ])
                            ->columns(2)
                            ->visible(function ($get) {
                                return $get('format') == 'bulan';
                            }),

                        Select::make('tahun')
                            ->required()
                            ->options(
                                function(){
                                    $tahun = range(date('Y'), 2023);
                                    $result = [];
                                    foreach ($tahun as  $value) {
                                        $result[$value] = $value;
                                    }
                                    return $result;
                                }
                            )->native(false)
                            ->visible(function ($get) {
                                return $get('format') == 'tahun';
                            }),

                        Group::make([
                            DatePicker::make('start_date')
                                ->required()
                                ->label('Tanggal Awal')
                                ->required()
                                ->native(false),
                            DatePicker::make('end_date')
                                ->label('Tanggal Akhir')
                                ->required()
                                ->required()
                                ->native(false)
                        ])
                            ->columns(2)
                            ->visible(function ($get) {
                                return $get('format') == 'range';
                            })
                    ]);
                })->action(function($data){
                    return Excel::download(new BusTicketExport($data), 'bus_tickets'.now()->format('Y-m-d_h-i').'.xlsx');
                })
        ];
    }
}

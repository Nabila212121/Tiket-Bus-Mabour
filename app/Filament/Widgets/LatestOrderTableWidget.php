<?php

namespace App\Filament\Widgets;

use App\Models\BusTicket;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrderTableWidget extends BaseWidget
{

    protected static ?int $sort = 2;

    //span
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                BusTicket::latest()
            )
            ->columns([
                Tables\Columns\ImageColumn::make('qr_image')
                    ->label('QR Code'),
                Tables\Columns\TextColumn::make('order_id')
                    ->label('Order ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bus.name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('seat_number')
                    ->sortable(),
                Tables\Columns\TextColumn::make('departure_time')
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
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}

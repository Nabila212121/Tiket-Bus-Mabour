<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusScheduleResource\Pages;
use App\Filament\Resources\BusScheduleResource\RelationManagers;
use App\Models\Bus;
use App\Models\BusSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusScheduleResource extends Resource
{
    protected static ?string $model = BusSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Jadwal Bus';

    protected static ?string $navigationGroup = 'Bus';

    //sort
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TimePicker::make('departure_time')

                    ->required(),

                Forms\Components\Select::make('bus')
                    ->relationship(titleAttribute:'name')
                    ->multiple()
                    ->options(
                        Bus::all()->pluck('name', 'id')->toArray( )
                    )
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('#ID')
                ->formatStateUsing(function($state){
                    return sprintf("#SCH%04d", $state);
                })
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departure_time'),
                Tables\Columns\ToggleColumn::make('active')
                ->label('Tampilkan di Halaman Depan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBusSchedules::route('/'),
            'create' => Pages\CreateBusSchedule::route('/create'),
            'edit' => Pages\EditBusSchedule::route('/{record}/edit'),
        ];
    }
}

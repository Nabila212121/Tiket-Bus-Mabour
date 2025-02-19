<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use App\Filament\Resources\BusResource\RelationManagers;
use App\Models\Bus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'Bus';

    protected static ?string $navigationGroup = 'Bus';


    //sort
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Bus')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('license_plate')
                            ->label('Plat Nomor')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('capacity')
                            ->label('Kapasitas')
                            ->required(),
                    ])->columns(2),
                    Forms\Components\FileUpload::make('image')
                        ->label('Foto Bus')
                        ->image(),
                ])->columnSpanFull()->columns(2),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')
                ->label('#ID')
                ->formatStateUsing(function ($state) {
                    return sprintf("#BUS%04d", $state);
                })
                ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Bus')
                    ->searchable(),
                Tables\Columns\TextColumn::make('license_plate')
                    ->label('Plat Nomor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Kapasitas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('active'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
            'edit' => Pages\EditBus::route('/{record}/edit'),
        ];
    }
}

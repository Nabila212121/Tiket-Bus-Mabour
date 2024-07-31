<?php

namespace App\Filament\Resources\BusTicketResource\Pages;

use App\Filament\Resources\BusTicketResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusTicket extends EditRecord
{
    protected static string $resource = BusTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

}

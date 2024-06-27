<?php

namespace App\Filament\Resources\BusTicketResource\Pages;

use App\Filament\Resources\BusTicketResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBusTicket extends CreateRecord
{
    protected static string $resource = BusTicketResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}

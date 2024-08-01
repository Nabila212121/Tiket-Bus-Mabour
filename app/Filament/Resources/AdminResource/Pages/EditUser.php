<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = AdminResource::class;


    protected static ?string $title = 'Edit Admin';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
<<<<<<< HEAD

=======
>>>>>>> f5e9f0b65f4f6f890ee169379c896ed5aacec558
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
<<<<<<< HEAD

=======
>>>>>>> f5e9f0b65f4f6f890ee169379c896ed5aacec558
}

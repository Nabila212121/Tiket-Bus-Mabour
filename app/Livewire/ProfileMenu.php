<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Actions\Action;
use Livewire\Component;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;

class ProfileMenu extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function profile(): Action
    {
        return Action::make('profile')
            ->label('Profile')
            ->link()
            ->fillForm(function ($data) {
                $users = auth()->user();
                $data['name'] = $users->name;
                $data['email'] = $users->email;
                $data['photo'] = $users->photo;
                $data['phone'] = $users->phone;
                return $data;
            })
            ->form(function ($form) {
                return $form->schema([
                    Group::make([
                        FileUpload::make('photo')->avatar()->image(),
                        Group::make([
                            TextInput::make('email')->readOnly(),
                            TextInput::make('name')->label('Nama Lengkap')->placeholder('Name')->required(),
                        ])->columns(1)->columnSpan(2)
                    ])->columns(3),
                    TextInput::make('phone')->label('Nomor Telepon'),
                ]);
            })
            ->action(function ($data) {
                $users = auth()->user();
                User::find($users->id)->update([
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'photo' => $data['photo']
                ]);
                Notification::make('profile')->title('Profile Updated')->body('Profile has been updated')->success()->send();
                return redirect('/');
            });
    }

    public function myTicket(): Action
    {
        return Action::make('myTicket')
            ->link()
            ->url('/my-tiket');
    }

    public function logout(): Action
    {
        return Action::make('logout')
            ->label('Keluar')
            ->link()
            ->color('danger')
            ->requiresConfirmation()
            ->action(function () {
                auth()->logout();
                return redirect('/');
            });
    }

    public function render()
    {
        return view('livewire.profile-menu');
    }
}

<?php

namespace App\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;

class Register extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('id_image')
                    ->label('Foto KTP')
                    ->image()
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique('users', 'email'),
                TextInput::make('password')
                    ->password()
                    ->minLength(8)
                    ->required()
                    ->revealable(),
            ])
            ->statePath('data');
    }

    public function register()
    {
        /**
         * @var Form $data
         */
        $data  = $this->form->getState();

        $user = User::create($data);

        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('components.layouts.auth');
    }
}

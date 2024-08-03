<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Middleware\EnsureUserIsVerifiedOrGuest;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::view('/', 'welcome')->name('welcome');


Route::view('/', 'users.home')->name('home')->middleware([EnsureUserIsVerifiedOrGuest::class]);
Route::view('/tiket', 'users.tiket')->name('tiket')->middleware([EnsureUserIsVerifiedOrGuest::class]);
Route::view('/rute', 'users.rute')->name('rute')->middleware([EnsureUserIsVerifiedOrGuest::class]);

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
    
    
    Route::get('/my-tiket',[OrderController::class, 'myTiket'])->name('my-tiket')->middleware([EnsureUserIsVerifiedOrGuest::class]);
    Route::get('/my-tiket/{ticket}',[OrderController::class, 'printTicket'])->name('my-tiket.print')->middleware([EnsureUserIsVerifiedOrGuest::class]);
    Route::get('/my-tiket/{ticket}/verify',[OrderController::class, 'verifyTicket'])->name('my-tiket.verify');

    Route::get('/tiket/{order}', [OrderController::class, 'order'])->name('order')->middleware([EnsureUserIsVerifiedOrGuest::class]);
});


Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');
    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});


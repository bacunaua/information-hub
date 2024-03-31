<?php

use App\Livewire\Admin;
use App\Livewire\Events;
use App\Livewire\Holidays;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/calendar', 'calendarapp');
Route::view('/admin', 'adminpage');
Route::get('/events', Events::class);
Route::get('/holidays', Holidays::class);
Route::get('/admin_class', Admin::class);


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

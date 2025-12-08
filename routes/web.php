<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pokemons;
use App\Livewire\Encounter;
use App\Livewire\MyPokemons;

Route::get('/my-pokemons', MyPokemons::class)->middleware('auth');

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/pokemons', Pokemons::class)->middleware('auth');

Route::get('/encounter', Encounter::class)->middleware('auth');

Route::get('/shop', \App\Livewire\Shop::class)->middleware('auth')->name('shop');

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pokemons;
use App\Livewire\Encounter;
use App\Livewire\MyPokemons;
use App\Livewire\Shop;

/*
|--------------------------------------------------------------------------
| Routes protégées (connexion obligatoire)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/my-pokemons', MyPokemons::class)->name('my-pokemons');

    Route::get('/pokemons', Pokemons::class)->name('pokemons');

    Route::get('/encounter', Encounter::class)->name('encounter');

    Route::get('/shop', Shop::class)->name('shop');

    Route::view('/profile', 'profile')->name('profile');

});

/*
|--------------------------------------------------------------------------
| Routes désactivées / supprimées
|--------------------------------------------------------------------------
*/
// ❌ Page d'accueil désactivée
// Route::view('/', 'welcome');

// ❌ Dashboard désactivé
// Route::view('/dashboard', 'dashboard')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Auth (login, register, password reset, etc.)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Pokemons extends Component
{
    public $pokemons = [];

    public function mount()
    {
        $response = Http::get(env('POKEMON_API_URL') . '/pokemon');

        if ($response->successful()) {
            $this->pokemons = $response->json();
        }
    }

public function render()
{
    return view('livewire.pokemons')->layout('livewire.layout.app');
}

}

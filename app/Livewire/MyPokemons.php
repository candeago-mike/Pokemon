<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CapturedPokemon;

class MyPokemons extends Component
{
    public $pokemons;

    public function mount()
    {
        $this->pokemons = CapturedPokemon::where('user_id', auth()->id())->get();
    }

    public function render()
    {
        return view('livewire.my-pokemons')->layout('livewire.layout.app');
    }
}

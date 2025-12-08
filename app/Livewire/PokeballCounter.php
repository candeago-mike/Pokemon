<?php

namespace App\Livewire;

use Livewire\Component;

class PokeballCounter extends Component
{
public $pokeball; // Livewire property

public function mount()
{
    $this->pokeball = ''; // <- important ! initialiser

    $user = auth()->user();

    foreach ($user->pokeballs as $ball) {
        $quantity = $ball->pivot->quantity ?? 0;
        $this->pokeball .= $ball->name . ' : ' . $quantity . "\n";
    }
}


    protected $listeners = [
        'pokeballsUpdated' => 'refreshCount'
    ];

public function refreshCount()
{
    $this->pokeball = ''; // reset

    $user = auth()->user();

    foreach ($user->pokeballs as $ball) {
        $quantity = $ball->pivot->quantity ?? 0;
        $this->pokeball .= $ball->name . ' : ' . $quantity . "\n";
    }
}

    public function render()
    {
        return view('livewire.pokeball-counter');
    }
}

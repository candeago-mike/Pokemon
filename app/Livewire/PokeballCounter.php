<?php

namespace App\Livewire;

use Livewire\Component;

class PokeballCounter extends Component
{
    public $pokeball;
    protected $listeners = [
        'pokeballsUpdated' => 'refreshCount'
    ];
    public function mount()
    {
        $this->refreshCount();
    }

    public function refreshCount()
    {

        $this->pokeball = '';

        $user = auth()->user()->load('pokeballs'); // important !

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

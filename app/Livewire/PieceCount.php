<?php

namespace App\Livewire;

use Livewire\Component;

class PieceCount extends Component
{
    public $piece;

    public function mount()
    {
        $this->piece = auth()->user()->coins ?? 0;
    }

    protected $listeners = [
        'piecesUpdated' => 'refreshCount'
    ];

    public function refreshCount()
    {
        $this->piece = auth()->user()->coins;
    }

    public function render()
    {
        return view('livewire.piece-count');
    }
}

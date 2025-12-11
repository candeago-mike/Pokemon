<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ShopItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Shop extends Component
{
    public $items;
    public $message;
    public bool $isOpen = false;

    #[On('openShop')]
    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
        $this->message = null; // ← IMPORTANT
    }

    public function mount()
    {
        $this->items = ShopItem::all();
    }


public function buy($id)
{
    $item = ShopItem::findOrFail($id);
    $user = Auth::user();

    if ($user->coins < $item->price) {
        $this->message = "Pas assez de pièces !";
        return;
    }

    // Déduire les pièces
    $user->coins -= $item->price;
    $user->save();
    // Vérifier si l’item existe déjà dans l’inventaire
    $existing = $user->pokeballs()->where('pokeball_id', $item->id)->first();

    if ($existing) {
        // Augmenter la quantité
        $user->pokeballs()->updateExistingPivot($item->id, [
            'quantity' => $existing->pivot->quantity + 1
        ]);
    } else {
        // Ajouter dans l’inventaire
        $user->pokeballs()->attach($item->id, ['quantity' => 1]);
    }

    $user->refresh();
    // informer les autres composants
    $this->dispatch('piecesUpdated');
    $this->dispatch('pokeballsUpdated');

    $this->message = "{$item->name} achetée !";

}


    public function render()
    {
        return view('livewire.shop', [
            'items' => $this->items,
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\CapturedPokemon;

class Encounter extends Component
{
    public $chance;
    public $pokemon;
    public $message = null;
    public $pokeball = [];
public $selectedPokeballId = null;
public $userPokeballs = [];
public $computedChances = [];
protected $listeners = [
    'animation-finished' => 'animationFinished',
];

public function mount()
{
    $this->loadRandomPokemon();
    $this->loadUserPokeballs();
}
public function loadUserPokeballs()
{
    $user = auth()->user();
    // récupère toutes les Pokéballs de l'utilisateur avec quantité
    $this->userPokeballs = $user->pokeballs->mapWithKeys(function ($ball) {
        return [$ball->id => [
            'name' => $ball->name,
            'quantity' => $ball->pivot->quantity,
            'bonus' => $ball->bonus,
        ]];
    })->toArray();

    // sélection par défaut si disponible
    $this->selectedPokeballId = array_key_first($this->userPokeballs);
    $this->updateChances();
}
public function loadRandomPokemon()
{
    $response = Http::withoutVerifying()->get('https://pokemonapi.mikecandeago.fr/pokemon');
    $pokemons = $response->json();
    $this->pokemon = collect($pokemons)->random();
    $this->dispatch('pokemon-updated', name: $this->pokemon['name']);


    $this->updateChances();
}



public function updatedSelectedPokeballId()
{
    $this->updateChances();
}
public function selectPokeball($id)
{
    $this->selectedPokeballId = $id;
}

public function updateChances()
{
    if (!$this->pokemon) return;

    $baseRate = $this->pokemon['capture_rate'];

    $this->computedChances = [];

    foreach ($this->userPokeballs as $id => $ball) {
        if($baseRate > 100){
            $chance = ($baseRate / 255) *30* $ball['bonus'];
            $this->computedChances[$id] = round($chance, 2);
        }else{
            $chance = ($baseRate / 255) *60* $ball['bonus'];
            $this->computedChances[$id] = round($chance, 2);
        }

    }
}


public function capture()
{
    $user = auth()->user();

    if (!$this->selectedPokeballId) {
        $this->message = "Tu dois choisir une Pokéball !";
        return;
    }

    $ballData = $this->userPokeballs[$this->selectedPokeballId];

    if ($ballData['quantity'] <= 0) {
        $this->message = "Tu n’as plus de " . $ballData['name'] . " !";
        return;
    }
    
    // Calcul de la probabilité avec bonus
    $baseRate = $this->pokemon['capture_rate'];
    $chance = ($baseRate / 255) * 50 * $ballData['bonus']; // bonus appliqué

    $roll = rand(0, 100);

    if ($roll <= $chance) {
        // Pokémon capturé
        CapturedPokemon::create([
            'user_id' => $user->id,
            'name'    => $this->pokemon['name'],
            'sprite'  => $this->pokemon['sprite'],
            'api_id'  => $this->pokemon['id'],
        ]);

        // Récompense en coins selon catch rate
        if ($baseRate > 200) {
            $user->coins += 25;
        } elseif ($baseRate > 100) {
            $user->coins += 40;
        } else {
            $user->coins += 50;
        }

        $this->message = "Bravo ! Tu as capturé " . $this->pokemon['name'] . " !";

    } else {
        $this->message = "Oh non ! Le Pokémon s’est échappé...";

    }

    // cet event sert juste à dire au JS d’afficher $message
    $this->dispatch('encounter-show-message', [
        'message' => $this->message,
    ]);

    // Décrémenter la Pokéball utilisée
    $user->pokeballs()->updateExistingPivot($this->selectedPokeballId, [
        'quantity' => $ballData['quantity'] - 1
    ]);

    $user->save();

        
    $this->dispatch("pokeballsUpdated");
    $this->dispatch("piecesUpdated");
    // Recharger l’inventaire
    $this->loadUserPokeballs();

}


public function animationFinished()
{
    // on efface le message pour ne plus le rerendre dans le Blade
    $this->message = null;

    // puis on charge un nouveau Pokémon
    $this->loadRandomPokemon();
}

    public function render()
    {
        return view('livewire.encounter')->layout('livewire.layout.app');
    }
}

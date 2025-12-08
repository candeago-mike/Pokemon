<div class="flex flex-col items-center justify-center mt-10">

    @if($pokemon)
        <h2 class="text-2xl font-bold mb-4">{{ $pokemon['name'] }}</h2>

        <img src="{{ $pokemon['sprite'] }}" class="w-40 h-40 mb-6">

        <button wire:click="capture"
                class="px-4 py-2 bg-red-600 text-white rounded-lg mb-4">
            Capturer !
        </button>

        <button wire:click="loadRandomPokemon"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg">
            Un autre Pokémon !
        </button>
    @endif

    @if($message)
        <p class="mt-4 text-xl font-bold text-center">{{ $message }}</p>
    @endif

<label>Choisir une Pokéball :</label>
<select wire:model="selectedPokeballId">
    @foreach($userPokeballs as $id => $ball)
        <option value="{{ $id }}">
            {{ $ball['name'] }} ({{ $ball['quantity'] }}) 
            — Chance : {{ $computedChances[$id] ?? 0 }}%
        </option>
    @endforeach
</select>


<script>
    window.addEventListener('load-new-pokemon', () => {
        setTimeout(() => {
            @this.loadRandomPokemon();
            @this.set('message', null);
        }, 1000); // 1 seconde
    });
</script>

</div>

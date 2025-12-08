<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Liste des Pokémon</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($pokemons as $pokemon)
            <div class="border p-4 rounded">
                <img src="{{ $pokemon['sprite'] }}" alt="{{ $pokemon['name'] }}" class="w-20 mx-auto">
                <h2 class="text-center font-semibold mt-2">{{ $pokemon['name'] }}</h2>
                <p class="text-center text-gray-500 text-sm">
                    Taux capture : {{ $pokemon['capture_rate'] }}
                </p>
            </div>
        @endforeach
    </div>
</div>

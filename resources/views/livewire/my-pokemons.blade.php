<div class="max-w-5xl mx-auto mt-10">

    <h1 class="text-3xl font-bold mb-6">Mes Pokémon capturés</h1>

    @if($pokemons->isEmpty())
        <p class="text-gray-600">Tu n’as encore capturé aucun Pokémon...</p>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($pokemons as $p)
                <div class="border rounded-lg p-4 text-center shadow">
                    <img src="{{ $p->sprite }}" class="w-24 h-24 mx-auto">
                    <h2 class="mt-2 font-bold">{{ $p->name }}</h2>
                    <p class="text-sm text-gray-500">#{{ $p->api_id }}</p>
                </div>
            @endforeach
        </div>
    @endif

</div>

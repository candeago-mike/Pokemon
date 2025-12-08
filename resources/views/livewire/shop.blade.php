<div>
    <h2 class="text-xl font-bold mb-4">Boutique</h2>

    <div class="grid grid-cols-3 gap-4">

        @foreach($items as $item)
            <div class="border p-4 rounded">
                <h3 class="font-bold">{{ $item->name }}</h3>
                <p>Prix : {{ $item->price }} coins</p>

                <button wire:click="buy({{ $item->id }})"
                    class="mt-2 px-3 py-1 rounded">
                    Acheter
                </button>
            </div>
        @endforeach
    </div>

    @if($message)
        <p class="mt-4 text-green-500">{{ $message }}</p>
    @endif
</div>

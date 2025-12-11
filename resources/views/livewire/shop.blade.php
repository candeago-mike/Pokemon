<div>
    @if($isOpen)
        {{-- overlay --}}
        <div class="fixed inset-0 bg-black/50 z-[998]"></div>

        {{-- modale centrée --}}
        <div class="fixed z-[999] top-[10%] left-1/2 -translate-x-1/2
                    py-4 px-2 w-[550px]
                    border text-black rounded-lg bg-[#f1d17e] font-bold border-[5px] border-[#c9a64b]
                    flex flex-col items-center">
            <button wire:click="close"
                    class="right-0 top-[-50px] self-end rounded-md absolute text-xl text-white bg-[#c64653]
                           flex items-center justify-center cursor-pointer px-4 py-2">
                X
            </button>

            @foreach($items as $item)
                <div class="flex w-full justify-between items-center gap-2 px-4 py-2">
                    <div class="flex w-full justify-between items-center" >
                        <div class="flex items-center gap-2 ">
                            @if($item->name=='Pokeball')
                                <img src="{{ asset('images/Pokéball.png') }}" alt="Poke" class="w-6 h-6">
                            @elseif($item->name=='Superball')
                                <img src="{{ asset('images/Superball.png') }}" alt="Super" class="w-6 h-6">
                                @elseif($item->name=='Hyperball')
                                <img src="{{ asset('images/Hyperball.png') }}" alt="Ultra" class="w-6 h-6">
                            @else
                                <img src="{{ asset('images/Masterball.png') }}" alt="Master" class="w-6 h-6">
                            @endif
                            <h3>{{ $item->name }}</h3>
                        </div>
                        <div class="flex-1 border-b-[3px] h-[12px] border-dotted border-black mx-2"></div>
                        <div class="flex gap-1 items-center ">
                            <p>{{ $item->price }}</p>
                            <img src="{{ asset('images/piece.png') }}" alt="Piece Icon" class="w-4 h-4">
                        </div>
                    </div>        

                    <button wire:click="buy({{ $item->id }})"
                            class="transition-colors duration-200 ease-out hover:bg-[#c9a64b] hover:translate-y-[-4px] bg-[#16506a] text-white w-[150px] px-1 py-2 rounded">
                            Acheter
                    </button>
                </div>
            @endforeach

            @if($message)
                <p class="mt-4 text-black-500">{{ $message }}</p>
            @endif
        </div>
    @endif
</div>

<div class="flex flex-col items-center justify-center mt-10">
    <div class="background"></div>
    @if($pokemon)
    <div class="text-typing-container">
      <div class="wrapper">
        <span  wire:ignore id="text-typing"></span>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 100 100"
          class="triangle-text"
        >
          <polygon points="50 15, 100 100, 0 100" />
        </svg>
      </div>
    </div>
        <div class="pokemon">
            <a class="pokemon-link">
            <img wire:click="capture" src="{{ $pokemon['sprite'] }}" alt="{{ $pokemon['name'] }}" />
            </a>
        </div>
    @endif

    @if($message)
        <p class="mt-4 text-xl font-bold text-center">{{ $message }}</p>
    @endif

<div class="actions grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
    @foreach($userPokeballs as $id => $ball)
        <a 
        wire:click.prevent="selectPokeball({{ $id }})"
        class="flex flex-col"
        >
            <div class="q-text">
                <p> x {{ $ball['quantity'] }}</p>
            </div>        
            <img 
                src="{{ asset('images/' . $ball['name'] . '.png') }}" 
                alt="{{ $ball['name'] }}"
                class="pokeball"
            >
            <div class="chances-text">
                <p>{{ $computedChances[$id] ?? 0 }}%</p>
            </div>
        </a>
    @endforeach
</div>



<script>
    let currentPokemonName = "{{ $pokemon['name'] ?? '' }}";

    function playPokemonText(text) {
        const textEl = document.querySelector("#text-typing");
        textEl.textContent = "";

        gsap.to(textEl, {
            text: text,
            duration: 2,
            ease: "none",
        });
    }

    // Au premier affichage
    playPokemonText(currentPokemonName + " est apparu !");

    // Quand un nouveau Pokémon arrive
    window.addEventListener('pokemon-updated', (event) => {
        const newName = event.detail.name;
        playPokemonText(newName + " est apparu !");
    });

</script>

</div>

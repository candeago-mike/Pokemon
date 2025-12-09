<div class="flex flex-col items-center justify-center mt-10">
    <!-- <div class="background"></div> -->
    @if($pokemon)
    <div class="text-typing-container">
      <div class="wrapper">
        <span id="text-typing"></span>
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
                <a href="#" class="pokemon-link">
                <img src="{{ $pokemon['sprite'] }}" alt="{{ $pokemon['name'] }}" />
                </a>
            </div>

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

<div class="flex flex-col items-center justify-center mt-10"     
    class="flex flex-col items-center justify-center mt-10"
    id="pokemon-encounter"
    data-pokemon-name="{{ $pokemon['name'] ?? '' }}">
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
                <a href="#"
                class="pokemon-link"
                wire:click.prevent="capture">
                    <img src="{{ $pokemon['sprite'] }}" alt="{{ $pokemon['name'] }}" />
                </a>
            </div>

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

</div>

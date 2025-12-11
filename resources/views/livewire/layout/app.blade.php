<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/MorphSVGPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/SplitText.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/TextPlugin.min.js"></script>
@vite([
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/js/script.js',
    'resources/js/text-typing.js',
])

    @livewireStyles
</head>
<body>

    <!-- HEADER -->
    <header class="p-4 ">       
    <div>
        <a href="{{route('my-pokemons')}}" class="p-4 text-xl font-bold">Pokédex</a>
    </div>
    <div class="flex justify-between bg-white p-2 rounded shadow-md">
        @auth
        <livewire:piece-count />
        @endauth
        <a href="{{route('shop')}}" class="text-xl font-bold">
            <img src="{{ asset('images/shop-icon.png') }}" alt="Shop Icon" class="w-6 h-6">
        </a>
    </div>

    </header>


    <!-- CONTENU DE LA PAGE -->
    <main class="container mx-auto px-4">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- HEADER -->
    <header class="bg-white shadow p-4 mb-6">
        <h1 class="text-2xl font-bold">Pokédex</h1>
        @auth
    <livewire:pokeball-counter />
    <livewire:piece-count />
@endauth
    </header>

    <!-- CONTENU DE LA PAGE -->
    <main class="container mx-auto px-4">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RSDB - Rocksmith DLC Search</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" defer>

    @livewireStyles

    @if (App::environment('production'))
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161991132-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-161991132-1');
    </script>
    @endif
</head>

<body class="bg-gray-400">
    <div class="container">
        <div class="mt-12">
            <h1 class="font-bold text-gray-800 text-4xl">Rocksmith DLC Search</h1>
            <h3 class="text-lg">Searching {{ $song_count }} songs (and counting).</h3>
        </div>

        <h4 class="mt-4 font-bold text-lg text-blue-700">Tips</h4>
        <ul class="list-disc">
            <li class="ml-4">Click on a song to view more information about it.</li>
            <li class="ml-4">Clicking on a column heading will sort it by that column ascending or descending.</li>
        </ul>

        @livewire('song-table')
    </div>

    @livewire('song-modal')

    @livewireScripts

    <script>
        window.livewire.on('closeModal', () => window.livewire.emit('songSelected', null));
    </script>
</body>

</html>
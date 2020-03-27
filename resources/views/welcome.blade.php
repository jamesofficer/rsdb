<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RSDB - Rocksmith DLC Search</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" defer>

    @livewireStyles
</head>

<body class="bg-gray-400">
    <div class="container">
        <div class="mt-12">
            <h1 class="font-bold text-gray-800 text-4xl">Rocksmith DLC Search</h1>
            <h3>Searching {{ $song_count }} songs.</h3>
        </div>

        @livewire('song-table')
    </div>

    @livewire('song-modal')

    @livewireScripts
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Songsmith</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700;800&display=swap" rel="stylesheet" defer>

    @livewireStyles
</head>

<body class="bg-gray-400">
    <!-- <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div> -->

    <div class="container">
        <div class="mt-12">
            <h1 class="font-bold text-gray-800 text-4xl">Rocksmith DLC Search</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate temporibus repudiandae explicabo rem
                at officia aperiam iste distinctio. Adipisci error dolores molestiae delectus reprehenderit quibusdam
                earum cumque, quaerat similique magni?</p>
        </div>

        @livewire('song-table')
    </div>

    @livewireScripts
</body>

</html>

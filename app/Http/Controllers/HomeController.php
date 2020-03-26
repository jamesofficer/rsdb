<?php

namespace App\Http\Controllers;

use App\Song;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome', [
            'songs' => Song::with(['artist', 'album', 'pack'])->get(),
            'song_count' => Song::count(),
        ]);
    }
}

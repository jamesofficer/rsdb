<?php

namespace App\Http\Controllers;

use App\Song;

class SongController extends Controller
{
    public function index()
    {
        return Song::all();
    }
}

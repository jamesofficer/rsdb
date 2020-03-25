<?php

namespace App\Http\Livewire;

use App\Song;
use Livewire\Component;

class SongTable extends Component
{
    // public $songs = Song::all()->toArray();

    public function render()
    {
        $songs = Song::with(['artist', 'album', 'pack'])->get();

        return view('livewire.song-table', ['songs' => $songs]);
    }
}

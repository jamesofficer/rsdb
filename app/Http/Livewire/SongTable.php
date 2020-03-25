<?php

namespace App\Http\Livewire;

use App\Song;
use Livewire\Component;

class SongTable extends Component
{
    public $query = '';

    public function render()
    {
        return view('livewire.song-table', [
            'songs' => $this->getFilteredSongs()
        ]);
    }

    private function getFilteredSongs()
    {
        $songs = Song::all()->sortBy('title');

        if ($this->query) {
            $query = strtolower($this->query);

            $filteredSongs =  $songs->filter(function ($song) use ($query) {
                return strstr(strtolower($song->title), $query) ||
                    strstr(strtolower($song->artist_name), $query) ||
                    strstr(strtolower($song->album_name), $query) ||
                    strstr(strtolower($song->pack_name), $query);
            });

            return $filteredSongs;
        }

        return $songs;
    }
}

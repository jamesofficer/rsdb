<?php

namespace App\Http\Livewire;

use App\Song;
use Livewire\Component;

class SongTable extends Component
{
    public $query = '';
    public $sortBy = 'title';
    public $sortDirection = 'asc';

    public function render()
    {
        return view('livewire.song-table', [
            'songs' => $this->getFilteredSongs()
        ]);
    }

    public function sortBy(string $column)
    {
        if ($column === $this->sortBy) {
            $this->flipSortDirection();
        }

        $this->sortBy = $column;
    }

    private function flipSortDirection()
    {
        $this->sortDirection === 'asc' ? $this->sortDirection = 'desc' : $this->sortDirection = 'asc';
    }

    private function getFilteredSongs()
    {
        $songs = Song::all();

        // Sort the songs by direction and title.
        $this->sortDirection === 'asc' ? $songs = $songs->sortBy($this->sortBy) : $songs = $songs->sortByDesc($this->sortBy);

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

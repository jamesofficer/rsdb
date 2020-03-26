<?php

namespace App\Http\Livewire;

use App\Song;
use Livewire\Component;

class SongModal extends Component
{
    protected $listeners = ['songSelected' => 'setSong'];

    public $song;

    public function render()
    {
        return view('livewire.song-modal');
    }

    public function setSong($songId)
    {
        $this->song = Song::find($songId);
    }

    public function closeModal()
    {
        $this->song = null;
    }
}

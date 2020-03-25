<?php

namespace App\Http\Livewire;

use App\Song;
use Livewire\Component;

class SongModal extends Component
{
    protected $listeners = ['songSelected' => 'setSong'];

    public $song;
    public $visible = true;

    public function mount()
    {
        $this->song = Song::first();
    }

    public function render()
    {
        return view('livewire.song-modal');
    }

    public function setSong($songId)
    {
        $this->song = Song::find($songId);
        $this->visible = true;
    }

    public function closeModal()
    {
        $this->song = null;
        $this->visible = false;
    }
}

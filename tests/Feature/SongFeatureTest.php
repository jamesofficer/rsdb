<?php

namespace Tests\Feature;

use App\Song;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SongFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_retrieve_a_list_of_songs()
    {
        $songs = factory(Song::class, 1)->create();

        dump($songs->pack);


        $this->get('/api/songs')
            ->assertJsonFragment($songs->toArray())
            ->assertOk();
    }
}

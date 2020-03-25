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
        $songs = factory(Song::class, 5)->create();

        $response = $this->get('/api/songs')->assertOk();

        foreach ($songs as $song) {
            $response->assertSee($song->title);
        }
    }
}

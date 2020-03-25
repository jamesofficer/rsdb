<?php

use App\Pack;
use App\Album;
use App\Artist;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    public function run()
    {
        // Create 100 songs.
        for ($i = 0; $i < 100; $i++) {
            $artist = Artist::inRandomOrder()->first();
            $album = Album::where('artist_id', $artist->id)->inRandomOrder()->first();

            factory(App\Song::class)->create([
                'artist_id' => $artist->id,
                'album_id' => $album->id,
                'pack_id' => Pack::inRandomOrder()->first()->id,
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    public function run()
    {
        factory(App\Artist::class, 30)->create()->each(function ($artist) {
            // dump('artist is', $artist->albums);

            $artist->albums()->saveMany(
                factory(App\Album::class, mt_rand(1, 2))->create([
                    'artist_id' => $artist->id
                ])
            );
        });
    }
}

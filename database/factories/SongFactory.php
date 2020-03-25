<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Song;
use App\Pack;
use App\Album;
use App\Artist;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Song::class, function (Faker $faker, array $params) {
    $songTitle = ucwords($faker->unique()->words(mt_rand(1, 4), true));

    return [
        'slug' => Str::slug($songTitle),
        'title' => $songTitle,
        'steam_url' => $faker->url,
        'artist_id' => $params['artist_id'] ?? factory(Artist::class)->create()->id,
        'album_id' => $params['album_id'] ?? factory(Album::class)->create()->id,
        'pack_id' => $params['pack_id'] ?? factory(Pack::class)->create()->id,
    ];
});

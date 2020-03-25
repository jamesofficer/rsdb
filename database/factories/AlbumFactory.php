<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Album;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

$factory->define(Album::class, function (Faker $faker, array $params) {
    $albumName = ucwords($faker->unique()->words(mt_rand(1, 10), true));

    return [
        'slug' => Str::slug($albumName),
        'name' => $albumName,
        'date' => Carbon::now()
            ->subYears(mt_rand(0, 50))
            ->subMonths(mt_rand(0, 12))
            ->subDays(mt_rand(0, 365)),
        'artist_id' => $params['artist_id'] ?? factory(App\Artist::class)->create()->id,
    ];
});

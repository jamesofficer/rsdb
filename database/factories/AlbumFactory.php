<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Album;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

$factory->define(Album::class, function (Faker $faker) {
    $albumName = ucwords($faker->words(mt_rand(1, 5), true));

    return [
        'slug' => Str::slug($albumName),
        'name' => $albumName,
        'date' => Carbon::now()
            ->subYears(mt_rand(0, 50))
            ->subMonths(mt_rand(0, 12))
            ->subDays(mt_rand(0, 365))
    ];
});

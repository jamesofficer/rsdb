<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Artist;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Artist::class, function (Faker $faker) {
    $artistName = ucwords($faker->words(mt_rand(1, 3), true));

    return [
        'slug' => Str::slug($artistName),
        'name' => $artistName,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Artist;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Artist::class, function (Faker $faker) {
    $artistName = ucwords($faker->unique()->words(mt_rand(1, 5), true));

    return [
        'slug' => Str::slug($artistName),
        'name' => $artistName,
    ];
});

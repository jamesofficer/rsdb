<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pack;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

$factory->define(Pack::class, function (Faker $faker) {
    $packName = ucwords($faker->words(mt_rand(1, 5), true));

    return [
        'slug' => Str::slug($packName),
        'name' => $packName,
        'date' => Carbon::now()
            ->subYears(mt_rand(0, 8))
            ->subMonths(mt_rand(0, 12))
            ->subDays(mt_rand(0, 365))
    ];
});

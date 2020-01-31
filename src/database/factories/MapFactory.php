<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Map;
use Faker\Generator as Faker;

$factory->define(Map::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
        'vettoriale' => $faker->sha256,
    ];
});

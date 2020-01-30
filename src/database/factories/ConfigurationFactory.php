<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Configuration;
use Faker\Generator as Faker;

$factory->define(Configuration::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
        'valore' => $faker->word,
    ];
});

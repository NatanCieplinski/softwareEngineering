<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Report;
use Faker\Generator as Faker;

$factory->define(Report::class, function (Faker $faker) {
    return [
        'motivazione' => $faker->sentence,
        'admin_id' => 1+$faker->randomNumber%50,
        'user_id' => 1+$faker->randomNumber%50,
    ];
});

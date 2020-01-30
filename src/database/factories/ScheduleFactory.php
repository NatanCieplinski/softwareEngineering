<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    return [
        'data' => $faker->dateTime,
        'da_ora' => $faker->time,
        'ad_ora' => $faker->time,
        'classroom_id' => 1+$faker->randomNumber%15,
        'user_id' => 1+$faker->randomNumber%50,
    ];
});

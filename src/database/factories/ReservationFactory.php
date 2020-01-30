<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'data' => $faker->dateTime,
        'da_ora' => $faker->time,
        'ad_ora' => $faker->time,
        'posto' => $faker->randomDigit,
        'desk_id' => 1+$faker->randomNumber%150,
        'user_id' => 1+$faker->randomNumber%50,
    ];
});

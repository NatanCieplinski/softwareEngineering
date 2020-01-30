<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Desk;
use Faker\Generator as Faker;

$factory->define(Desk::class, function (Faker $faker) {
    return [
        'orientamento' => $faker->randomDigit%2,
        'x_pos' => DB::raw("ST_PointFromText('POINT(1 1)')"),
        'y_pos' => DB::raw("ST_PointFromText('POINT(2 2)')"),
        'desktype_id' => $faker->randomDigit+1,
    ];
});

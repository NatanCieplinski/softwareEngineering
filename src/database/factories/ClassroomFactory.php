<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Classroom;
use Faker\Generator as Faker;

$factory->define(Classroom::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
        'rumorosita' => $faker->randomDigit,
        'frequenza_ble' => $faker->randomDigit,
        'righe' => $faker->randomDigit,
        'colonne' => $faker->randomDigit,
        'disegno' => DB::raw("ST_GeomCollFromText('GEOMETRYCOLLECTION(POINT(1 1),LINESTRING(0 0,1 1,2 2,3 3,4 4))')") ,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Desktype;
use Faker\Generator as Faker;

$factory->define(Desktype::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
        'numero_posti' => $faker->randomDigit,
        'disegno' => DB::raw("ST_GeomCollFromText('GEOMETRYCOLLECTION(POINT(1 1),LINESTRING(0 0,1 1,2 2,3 3,4 4))')") ,
    ];
});

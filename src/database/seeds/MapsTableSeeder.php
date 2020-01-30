<?php

use Illuminate\Database\Seeder;

class MapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Map::class, 3)->create()
        ->each(function ($map) {
            $map->classrooms()->saveMany(
                factory(App\Classroom::class, 5)->make()
            );
        });
    }
}

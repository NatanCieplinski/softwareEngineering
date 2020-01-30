<?php

use Illuminate\Database\Seeder;

class DesksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desks = factory(App\Desk::class, 150)->make();
        $classroom = 15;
        for($i=0; $i<150; $i++){
            factory(App\Desk::class)->create(['classroom_id'=>round($classroom/15)]);
            $classroom++;
        }
    }
}

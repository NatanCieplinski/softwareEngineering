<?php

use Illuminate\Database\Seeder;

class ClosingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Closing::class, 20)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

class DesktypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Desktype::class, 10)->create();
    }
}

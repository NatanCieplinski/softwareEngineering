<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DesktypesTableSeeder::class,
            MapsTableSeeder::class,
            DesksTableSeeder::class,
            UsersTableSeeder::class,
            ConfigurationsTableSeeder::class,
            ReportsTableSeeder::class,
            ReservationsTableSeeder::class,
            ClosingsTableSeeder::class,
            SchedulesTableSeeder::class,
        ]);
    }
}

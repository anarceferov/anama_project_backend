<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PageSeeder;
use Database\Seeders\PagesSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ChronologySeeder;
use Database\Seeders\RegionSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            // PageSeeder::class,
            UserSeeder::class,
            RegionSeeder::class,
            // EmployeeSeeder::class,
            // AboutSeeder::class,
            // ChronologySeeder::class,
            // ImsmaSeeder::class,
            // PageSeeder::class,
            PagesSeeder::class,
            // PressSeeder::class,
            // ProcessesIconSeeder::class,
            // QualitySeeder::class,
            // ProcessSeeder::class,
            // FilesSeeder::class
        ]);
    }
}

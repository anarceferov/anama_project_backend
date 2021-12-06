<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PageSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ChronologySeeder;

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
            // EmployeeSeeder::class,
            // AboutSeeder::class,
            // ChronologySeeder::class,
            // ImsmaSeeder::class,
            // PageSeeder::class,
            // PressSeeder::class,
            // ProcessesIconSeeder::class,
            // QualitySeeder::class,
            // ProcessSeeder::class,
            // FilesSeeder::class
        ]);
    }
}

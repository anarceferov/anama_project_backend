<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PagesSeeder;
use Database\Seeders\PageSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RegionSeeder;


class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            RegionSeeder::class,
            // PageSeeder::class,
            PagesSeeder::class,
            // FilesSeeder::class
        ]);
    }
}

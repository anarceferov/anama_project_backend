<?php

namespace Database\Seeders;

use App\Models\Quality;
use Illuminate\Database\Seeder;

class QualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quality::factory(20)->create();

    }
}

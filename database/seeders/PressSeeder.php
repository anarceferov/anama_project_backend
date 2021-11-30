<?php

namespace Database\Seeders;

use App\Models\Press;
use Illuminate\Database\Seeder;

class PressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Press::factory(20)->create();

    }
}

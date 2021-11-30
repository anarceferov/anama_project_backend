<?php

namespace Database\Seeders;

use App\Models\Chronology;
use Illuminate\Database\Seeder;

class ChronologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chronology::factory(20)->create();

    }
}

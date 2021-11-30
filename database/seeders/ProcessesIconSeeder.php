<?php

namespace Database\Seeders;

use App\Models\ProcessesIcon;
use Illuminate\Database\Seeder;

class ProcessesIconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProcessesIcon::factory(20)->create();

    }
}

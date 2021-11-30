<?php

namespace Database\Seeders;

use App\Models\Imsma;
use Illuminate\Database\Seeder;

class ImsmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Imsma::factory(20)->create();

    }
}

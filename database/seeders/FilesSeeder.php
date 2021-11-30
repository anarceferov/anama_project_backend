<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class FilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::factory(20)->create();
    }
}

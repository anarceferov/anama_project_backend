<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Anar Ceferov',
            'email' => 'anarceferov1996@gmail.com',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name'=>'Murad Nerimanli',
            'email' => 'm.nerimanli@gmail.com',
            'password' => bcrypt('Murad2020!')
        ]);
    }
}

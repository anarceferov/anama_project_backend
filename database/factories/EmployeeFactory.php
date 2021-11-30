<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{

    protected $model = Employee::class;

    public function definition()
    {
        return [
            'text' => $this->faker->sentence(2,true),
            'text_en' => $this->faker->sentence(2,true).'________EN',
            'image' => 'https://via.placeholder.com/400/00000/',
            'order' =>  rand(1,100).''.rand(1,100),
            'position' => $this->faker->sentence(2,true),
            'position_en' =>$this->faker->sentence(2,true).'________EN',
            'position_name' =>$this->faker->sentence(2,true),
            'position_name_en' =>$this->faker->sentence(2,true).'________EN'
        ];
    }
}

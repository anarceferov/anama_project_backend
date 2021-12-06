<?php

namespace Database\Factories;

use App\Models\About;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{

    protected $model = About::class;

    public function definition()
    {
        return [
            'text' => $this->faker->sentence(1,true),
            // 'text_en' => $this->faker->sentence(1,true).'________EN',
            'image' => rand(1,20),
            'date' =>  $this->faker->year($max = 'now')
        ];
    }
}

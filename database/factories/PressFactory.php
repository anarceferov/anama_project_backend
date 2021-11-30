<?php

namespace Database\Factories;

use App\Models\Press;
use Illuminate\Database\Eloquent\Factories\Factory;

class PressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Press::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(1,true),
            'title_en' => $this->faker->sentence(1,true).'________EN',
            'file' => 'https://via.placeholder.com/400/00000/',
            'date' =>  $this->faker->year($max = 'now')
        ];
    }
}

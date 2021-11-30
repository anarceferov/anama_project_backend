<?php

namespace Database\Factories;

use App\Models\Quality;
use Illuminate\Database\Eloquent\Factories\Factory;

class QualityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Quality::class;

    public function definition()
    {
        return [
            'text' => $this->faker->sentence(2,true),
            'text_en' => $this->faker->sentence(2,true).'________EN',
            'image' => 'https://via.placeholder.com/400/00000/',

        ];
    }
}

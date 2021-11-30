<?php

namespace Database\Factories;

use App\Models\Chronology;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChronologyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Chronology::class;

    public function definition()
    {
        return [
            'text' => $this->faker->sentence(1,true),
            'text_en' => $this->faker->sentence(1,true).'________EN',
            'image' => 'https://via.placeholder.com/400/00000/',
            'date' =>  $this->faker->year($max = 'now')
        ];
    }
}

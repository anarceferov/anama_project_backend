<?php

namespace Database\Factories;

use App\Models\Process;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Process::class;

    public function definition()
    {
        return [
            'text' => $this->faker->sentence(2,true),
            // 'text_en' => $this->faker->sentence(2,true).'________EN',
            'image' => 'https://via.placeholder.com/400/00000/',
        ];
    }
}

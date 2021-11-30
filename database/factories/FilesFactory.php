<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilesFactory extends Factory
{
    protected $model = File::class;

    public function definition()
    {
        return [
            'path' => $this->faker->sentence(2,true),
            'extension' => $this->faker->sentence(1,true),
        ];
    }
}

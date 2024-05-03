<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'isbn' => $this->faker->unique()->isbn13(),
            'value' => $this->faker->randomFloat(2, 5, 150)
        ];
    }
}

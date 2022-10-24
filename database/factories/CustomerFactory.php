<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $shape = ['Round','Square','Hexagon'];
        return [
            'name' => $this->faker->company(),
            'size_1'    => $this->faker->randomFloat(2,3.01,40),
            'size_2'    => $this->faker->randomFloat(2,0,100),
            'shape'     => $shape[$this->faker->numberBetween(0,2)],
            'straightness_standard' => $this->faker->randomFloat(2,0,100)
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name'          => $this->faker->company(),
            'grade'         => $this->faker->word(),
            'diameter'      => $this->faker->randomFloat(2,3.01,40),
            'qty_kg'        => $this->faker->numberBetween(0,10000),
            'qty_coil'      => $this->faker->numberBetween(0,10),
        ];
    }
}

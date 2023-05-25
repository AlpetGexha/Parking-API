<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zone>
 */
class ZoneFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'price_per_hour' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}

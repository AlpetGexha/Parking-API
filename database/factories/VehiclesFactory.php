<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles>
 */
class VehiclesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'plate_number' => $this->faker->regexify('/07-[1-7]{1}[0-9]{2}-[A-F]{2}/'),
            'brand' => $this->faker->randomElement(['Toyota', 'Honda', 'Ford', 'Chevrolet']),
            'model' => $this->faker->word,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Santri>
 */
class SantriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'nis' => fake()->randomNumber(9, true),
            'operator_id' => User::factory()
        ];
    }

    public function status_spp(): static
    {
        return $this->state(fn(array $attributes) => [
            'status_spp' => true,
        ]);
    }
}

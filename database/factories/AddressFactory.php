<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_code' => $this->faker->postcode,
            'street' => $this->faker->streetAddress,
            'number' => $this->faker->buildingNumber,
            'neighborhood' => $this->faker->word,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'complement' => $this->faker->optional()->word,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

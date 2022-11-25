<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->streetName(),
            //@todo change to enum
            'type' => fake()->word(),
            //@todo change to Money
            'start_balance_amount' => 0,
            'start_balance_currency' => 'RUB',
            'balance_amount' => 0,
            'balance_currency' => 'RUB',
        ];
    }
}

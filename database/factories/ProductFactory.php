<?php

namespace Database\Factories;

use App\Constants\ProductTypeEnum;
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
            'type' => ProductTypeEnum::ACCOUNT->value,
            //@todo change to Money
            'start_balance_amount' => 0,
            'start_balance_currency' => 'RUB',
            'balance_amount' => 0,
            'balance_currency' => 'RUB',
            'bank_loan_amount' => 0,
        ];
    }
}

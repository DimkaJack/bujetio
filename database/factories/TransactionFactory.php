<?php

namespace Database\Factories;

use App\Constants\TransactionTypeEnum;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;
use Money\Currencies\CurrencyList;
use Money\Currency;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //@todo change to enum
            'type' => TransactionTypeEnum::INCOME->value,
            'amount_amount' => fake()->numerify('####'),
            'amount_currency' => 'RUB',
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Constants\ProductTypeEnum;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userid = User::first()->id;

        Product::factory()->create([
            'name' => 'Кредитка',
            'type' => ProductTypeEnum::CREDIT_CARD,
            'bank_loan_amount' => 100000,
            'start_balance_amount' => 1000,
            'balance_amount' => 1000,
            'user_id' => $userid,
        ]);
        Product::factory()->create([
            'name' => 'Дебетовая',
            'type' => ProductTypeEnum::DEBIT_CARD,
            'start_balance_amount' => 1000,
            'balance_amount' => 1000,
            'user_id' => $userid,
        ]);
        Product::factory()->create([
            'name' => 'Кредит',
            'type' => ProductTypeEnum::CREDIT_LOAN,
            'bank_loan_amount' => 10000,
            'user_id' => $userid,
        ]);
        Product::factory()->create([
            'name' => 'Накопительный счет',
            'type' => ProductTypeEnum::ACCOUNT,
            'start_balance_amount' => 1000,
            'balance_amount' => 1000,
            'user_id' => $userid,
        ]);
    }
}

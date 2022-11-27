<?php

declare(strict_types=1);

namespace Tests\Feature\Products;

use App\Constants\ProductTypeEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();

        $request = [
            'name' => fake()->name,
            'type' => ProductTypeEnum::DEBIT_CARD->value,
            'startBalanceAmount' => 0,
            'startBalanceCurrency' => 'RUB',
            'balanceAmount' => 0,
            'balanceCurrency' => 'RUB',
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->postJson('/api/products', $request);

        $response->assertStatus(201);//->assertJsonCount();
    }
}

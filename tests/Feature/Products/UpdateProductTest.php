<?php

declare(strict_types=1);

namespace Tests\Feature\Products;

use App\Constants\ProductTypeEnum;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();
        $product = Product::factory()
            ->for($user)
            ->create();

        $request = [
            'name' => fake()->name,
            'type' => ProductTypeEnum::CREDIT_CARD->value,
            'startBalanceAmount' => 100,
            'startBalanceCurrency' => 'RUB',
            'balanceAmount' => 100,
            'balanceCurrency' => 'RUB',
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->patchJson('/api/products/' . $product->id, $request);

        $response->assertStatus(200);//->assertJsonCount();
    }
}

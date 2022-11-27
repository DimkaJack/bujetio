<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StoreTransactionTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();

        /** @var Product $product */
        $product = Product::factory()->create();
        /** @var Category $category */
        $category = Category::factory()->create();

        $request = [
            'type' => 1,
            'amount' => 10,
            'currency' => 'RUB',
            'productId' => $product->id,
            'categoryId' => $category->id,
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->postJson('/api/transactions', $request);

        $response->assertStatus(201);//->assertJsonCount();
    }
}

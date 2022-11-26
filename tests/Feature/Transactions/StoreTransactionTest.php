<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StoreTransactionTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
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

        $response = $this->postJson('/api/transactions', $request);

        $data = $response->getContent();
        $response->assertStatus(201);//->assertJsonCount();
    }
}

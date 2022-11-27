<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListTransactionTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();
        Transaction::factory()
            ->for(Product::factory()->create())
            ->for(Category::factory()->create())
            ->create();

        //@todo find auth request base
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/api/transactions');

        $response->assertStatus(200)->assertJsonCount(1, 'data');
    }
}

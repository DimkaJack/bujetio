<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListTransactionTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $transaction = Transaction::factory()
            ->for(Product::factory()->create())
            ->for(Category::factory()->create())
            ->create();
        $response = $this->get('/api/transactions');

        $data = $response->getContent();
        $response->assertStatus(200);//->assertJsonCount();
    }
}

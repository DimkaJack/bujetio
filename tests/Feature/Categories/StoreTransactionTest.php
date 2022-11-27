<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StoreTransactionTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();

        $request = [
            'name' => fake()->name,
            'color' => fake()->colorName,
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->postJson('/api/categories', $request);

        $response->assertStatus(201);//->assertJsonCount();
    }
}

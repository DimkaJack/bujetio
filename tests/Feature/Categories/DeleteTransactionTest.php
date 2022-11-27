<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DeleteTransactionTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();
        $category = Category::factory()
            ->for($user)
            ->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->deleteJson('/api/categories/' . $category->id);

        $response->assertStatus(200);//->assertJsonCount();
    }
}

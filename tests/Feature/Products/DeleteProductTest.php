<?php

declare(strict_types=1);

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();
        $product = Product::factory()
            ->for($user)
            ->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->deleteJson('/api/products/' . $product->id);

        $response->assertStatus(200);//->assertJsonCount();
    }
}

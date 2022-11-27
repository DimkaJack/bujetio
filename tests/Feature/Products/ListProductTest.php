<?php

declare(strict_types=1);

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();
        Product::factory()
            ->for($user)
            ->create();

        //@todo find auth request base
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/api/products');

        $response->assertStatus(200)->assertJsonCount(1, 'data');
    }
}

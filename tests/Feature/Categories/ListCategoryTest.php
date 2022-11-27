<?php

declare(strict_types=1);

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListCategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();
        Category::factory()
            ->for($user)
            ->create();

        //@todo find auth request base
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/api/categories');

        $response->assertStatus(200)->assertJsonCount(1, 'data');
    }
}

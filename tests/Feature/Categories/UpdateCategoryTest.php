<?php

declare(strict_types=1);

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();
        $category = Category::factory()
            ->for($user)
            ->create();

        $request = [
            'name' => fake()->name,
            'color' => fake()->hexColor,
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->patchJson('/api/categories/' . $category->id, $request);

        $response->assertStatus(200);//->assertJsonCount();
    }
}

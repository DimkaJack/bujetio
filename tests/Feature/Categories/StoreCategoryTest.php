<?php

declare(strict_types=1);

namespace Tests\Feature\Categories;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StoreCategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccess()
    {
        $user = User::factory()->create();

        $request = [
            'name' => fake()->name,
            'color' => fake()->hexColor(),
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->postJson('/api/categories', $request);

        $response->assertStatus(201);//->assertJsonCount();
    }
}

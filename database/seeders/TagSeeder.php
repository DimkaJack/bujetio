<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userId = User::first()->id;

        Tag::factory()->create([
            'name' => 'Bank A',
            'color' => 'green',
            'user_id' => $userId,
        ]);
        Tag::factory()->create([
            'name' => 'Bank B',
            'color' => 'yellow',
            'user_id' => $userId,
        ]);
        Tag::factory()->create([
            'name' => 'Cruise',
            'color' => 'red',
            'user_id' => $userId,
        ]);
        Tag::factory()->create([
            'name' => 'Зарплата',
            'color' => 'blue',
            'user_id' => $userId,
        ]);
    }
}

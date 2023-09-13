<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userid = User::first()->id;

        Category::factory()->create([
            'name' => 'Переводы',
            'color' => 'green',
            'user_id' => $userid,
        ]);
        Category::factory()->create([
            'name' => 'ЖКХ',
            'color' => 'blue',
            'user_id' => $userid,
        ]);
        Category::factory()->create([
            'name' => 'Продукты',
            'color' => 'red',
            'user_id' => $userid,
        ]);
    }
}

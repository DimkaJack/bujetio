<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Category\CategoryStoreDto;
use App\Dto\Category\CategoryUpdateDto;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\UuidInterface;

final class CategoryService
{
    public function getList(): Collection
    {
        $response = Category::all();
        return $response;
    }

    public function store(CategoryStoreDto $dto): Category
    {
        $category = new Category();
        $category->name = $dto->name;
        $category->color = $dto->color;
        $category->user()->associate(Auth::user());
        $category->save();

        return $category;
    }

    public function update(CategoryUpdateDto $dto): Category
    {
        $category = Category::find($dto->id);
        $category->name = $dto->name;
        $category->color = $dto->color;
        $category->save();

        return $category;
    }

    public function updateByCategory(CategoryUpdateDto $dto, Category $category): Category
    {
        $category->name = $dto->name;
        $category->color = $dto->color;
        $category->save();

        return $category;
    }

    public function delete(UuidInterface $id): bool
    {
        //@todo add transaction
        $category = Category::find($id);
        $category->delete();

        return true;
    }

    public function deleteByCategory(Category $category): bool
    {
        $category->delete();

        return true;
    }
}

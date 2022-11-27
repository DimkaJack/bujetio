<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Product\ProductStoreDto;
use App\Dto\Product\ProductUpdateDto;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\UuidInterface;

final class ProductService
{
    public function getList(): Collection
    {
        $response = Product::all();
        return $response;
    }

    public function store(ProductStoreDto $dto): Product
    {
        $product = new Product();
        $product->name = $dto->name;
        $product->type = $dto->type->value;
        $product->start_balance_amount = $dto->startBalance->getAmount();
        $product->start_balance_currency = $dto->startBalance->getCurrency();
        $product->balance_amount = $dto->balance->getAmount();
        $product->balance_currency = $dto->balance->getCurrency();
        $product->user()->associate(Auth::user());
        $product->save();

        return $product;
    }

    public function update(ProductUpdateDto $dto): Product
    {
        $product = Product::find($dto->id);
        $product->name = $dto->name;
        $product->type = $dto->type->value;
        $product->start_balance_amount = $dto->startBalance->getAmount();
        $product->start_balance_currency = $dto->startBalance->getCurrency();
        $product->balance_amount = $dto->balance->getAmount();
        $product->balance_currency = $dto->balance->getCurrency();
        $product->save();

        return $product;
    }

    public function delete(UuidInterface $id): bool
    {
        //@todo add transaction
        $product = Product::find($id);
        $product->delete();

        return true;
    }
}

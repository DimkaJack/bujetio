<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Product\Dto\ProductStoreDto;
use App\Http\Requests\Product\Dto\ProductUpdateDto;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\UuidInterface;

final class ProductService
{
    public function getList(): Collection
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->products;
    }

    /**
     * @param UuidInterface $id
     * @return Product|null
     */
    public function get(UuidInterface $id): ?Product
    {
        /** @var User $user */
        $user = Auth::user();

        return $user->products()->where('id', $id)->first();
    }

    public function store(ProductStoreDto $dto): Product
    {
        $product = new Product();
        $product->name = $dto->name;
        $product->type = $dto->type->value;
        $product->startBalance = $dto->startBalance;
        $product->balance = $dto->startBalance;
        $product->bankLoan = $dto->bankLoan;
        $product->user()->associate(Auth::user());
        $product->save();

        return $product;
    }

    public function update(ProductUpdateDto $dto): Product
    {
        $product = Product::find($dto->id);

        return $this->updateByProduct($dto, $product);
    }

    public function updateByProduct(ProductUpdateDto $dto, Product $product): Product
    {
        //@todo create transaction when change balance
        $product->name = $dto->name;
        $product->type = $dto->type->value;
        $product->startBalance = $dto->startBalance;
        $product->bankLoan = $dto->bankLoan;
        $product->save();

        return $product;
    }

    public function delete(UuidInterface $id): bool
    {
        $product = Product::find($id);

        return $this->deleteByProduct($product);
    }

    public function deleteByProduct(Product $product): bool
    {
        //@todo add transaction
        $product->delete();

        return true;
    }
}

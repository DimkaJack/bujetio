<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Transaction\TransactionStoreDto;
use App\Dto\Transaction\TransactionUpdateDto;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

final class TransactionService
{
    public function getList(): Collection
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->transactions()->with(['product', 'category'])->get();
    }

    public function store(TransactionStoreDto $dto): Transaction
    {
        $transaction = new Transaction();
        $transaction->type = $dto->type->value;
        //@todo change to normal relationship save
        $transaction->product_id = $dto->productId;
        $transaction->category_id = $dto->categoryId;
        //@todo change to cast
        $transaction->amount_amount = $dto->amount->getAmount();
        $transaction->amount_currency = $dto->amount->getCurrency();
        $transaction->user()->associate(Auth::user());
        $transaction->save();

        return $transaction;
    }

    public function updateByTransaction(TransactionUpdateDto $dto, Transaction $transaction): Transaction
    {
        $transaction->type = $dto->type->value;
        //@todo change to normal relationship save
        $transaction->product_id = $dto->productId;
        $transaction->category_id = $dto->categoryId;
        //@todo change to cast
        $transaction->amount_amount = $dto->amount->getAmount();
        $transaction->amount_currency = $dto->amount->getCurrency();
        $transaction->save();

        return $transaction;
    }

    public function deleteByTransaction(Transaction $transaction): bool
    {
        $transaction->delete();

        return true;
    }
}

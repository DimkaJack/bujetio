<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Transaction\TransactionStoreDto;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

final class TransactionService
{
    public function getList(): Collection
    {
        $response = Transaction::all();
        return $response;
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
}

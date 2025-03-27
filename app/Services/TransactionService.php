<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\TransactionTypeEnum;
use App\Dto\Transaction\TransactionStoreDto;
use App\Dto\Transaction\TransactionUpdateDto;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

//@todo add db transactions
//@todo extract balance change to standalone service
final class TransactionService
{
    public function __construct(
        private readonly ProductService $productService,
    ) {
        //
    }

    public function getList(): Collection
    {
        return $this->filtered();
    }

    public function store(TransactionStoreDto $dto): Transaction
    {
        //@todo check product and transaction currency
        //@todo transaction amount should always be positive

        $product = $this->productService->get($dto->productId);

        // create transaction
        $transaction = new Transaction();
        $transaction->type = $dto->type->value;
        $transaction->name = $dto->name;
        //@todo change to normal relationship save
        $transaction->product_id = $dto->productId;
        $transaction->category_id = $dto->categoryId;
        $transaction->amount = $dto->amount;
        $transaction->pay_date = $dto->payDate;
        $transaction->user()->associate(Auth::user());
        $transaction->save();

        $transaction->tags()->sync($dto->tags);

        // change product balance
        if ($dto->type === TransactionTypeEnum::INCOME) {
            $product->balance = $product->balance->add($dto->amount);
        } else {
            $product->balance = $product->balance->subtract($dto->amount);
        }
        $product->save();

        return $transaction;
    }

    public function updateByTransaction(TransactionUpdateDto $dto, Transaction $transaction): Transaction
    {
        //@todo check product and transaction currency
        //@todo transaction amount should always be positive
        //@todo add logic if transaction product not same as dto product
        //@todo add transactions for each product

        $product = $this->productService->get($dto->productId);

        // @todo add logic when new type not same as old type
        if ($dto->type === TransactionTypeEnum::INCOME) {
            // rollback old transaction
            $product->balance = $product->balance->subtract($transaction->amount);
            // change product balance
            $product->balance = $product->balance->add($dto->amount);
        } else {
            // rollback old transaction
            $product->balance = $product->balance->add($transaction->amount);
            // change product balance
            $product->balance = $product->balance->subtract($dto->amount);
        }
        $product->save();

        $transaction->type = $dto->type;
        $transaction->name = $dto->name;
        //@todo change to normal relationship save
        $transaction->product_id = $dto->productId;
        $transaction->category_id = $dto->categoryId;
        $transaction->amount = $dto->amount;
        $transaction->pay_date = $dto->payDate;
        $transaction->tags()->sync($dto->tags);
        $transaction->save();

        return $transaction;
    }

    public function deleteByTransaction(Transaction $transaction): bool
    {
        $product = $this->productService->get(Uuid::fromString($transaction->product_id));

        // rollback old transaction
        if ($transaction->type === TransactionTypeEnum::INCOME) {
            $product->balance = $product->balance->subtract($transaction->amount);
        } else {
            $product->balance = $product->balance->add($transaction->amount);
        }
        $product->save();

        $transaction->delete();

        return true;
    }

    public function filtered(int $limit = 0): Collection
    {
        /** @var User $user */
        $user = Auth::user();
        $transactions = $user->transactions()->with(['product', 'category']);
        if ($limit > 0) {
            $transactions->limit($limit);
        }
        return $transactions->get();
    }
}

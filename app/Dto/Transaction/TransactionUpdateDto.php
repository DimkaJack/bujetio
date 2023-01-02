<?php

declare(strict_types=1);

namespace App\Dto\Transaction;

use App\Constants\TransactionTypeEnum;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class TransactionUpdateDto
{
    public function __construct(
        public readonly ?UuidInterface $id,
        public readonly TransactionTypeEnum $type,
        public readonly Money $amount,
        public readonly UuidInterface $productId,
        public readonly UuidInterface $categoryId,
    ) {
        //
    }

    public static function fromRequest(Request $request): self
    {
        $transactionType = TransactionTypeEnum::from($request->input('type'));
        $amount = money($request->input('amount'), currency($request->input('currency')));

        return new self(
            id: isset($request->uuid) ? Uuid::fromString($request->uuid) : null,
            type: $transactionType,
            amount: $amount,
            productId: Uuid::fromString($request->input('productId')),
            categoryId: Uuid::fromString($request->input('categoryId')),
        );
    }
}

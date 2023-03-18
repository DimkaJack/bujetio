<?php

declare(strict_types=1);

namespace App\Dto\Transaction;

use App\Constants\TransactionTypeEnum;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class TransactionStoreDto
{
    public function __construct(
        public readonly TransactionTypeEnum $type,
        public readonly Money $amount,
        public readonly UuidInterface $productId,
        public readonly UuidInterface $categoryId,
    ) {
        //
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            type: TransactionTypeEnum::from($request->input('type')),
            amount: Money::parseByDecimal(
                $request->input('amount'),
                currency($request->input('currency'))
            ),
            productId: Uuid::fromString($request->input('productId')),
            categoryId: Uuid::fromString($request->input('categoryId')),
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Dto\Transaction;

use App\Constants\TransactionTypeEnum;
use Carbon\Carbon;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class TransactionStoreDto
{
    public function __construct(
        public readonly TransactionTypeEnum $type,
        public readonly string $name,
        public readonly Money $amount,
        public readonly UuidInterface $productId,
        public readonly UuidInterface $categoryId,
        public readonly Carbon $payDate,
        public readonly array $tags = [],
    ) {
        //
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            type: TransactionTypeEnum::from($request->input('type')),
            name: $request->input('name'),
            amount: Money::parseByDecimal(
                $request->input('amount'),
                currency($request->input('currency'))
            ),
            productId: Uuid::fromString($request->input('productId')),
            categoryId: Uuid::fromString($request->input('categoryId')),
            payDate: new Carbon($request->input('payDate')),
            tags: $request->input('tags', []),
        );
    }
}

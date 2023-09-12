<?php

declare(strict_types=1);

namespace App\Dto\Transaction;

use App\Constants\TransactionTypeEnum;
use Carbon\Carbon;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class TransactionUpdateDto
{
    public function __construct(
        public readonly ?UuidInterface $id,
        public readonly TransactionTypeEnum $type,
        public readonly string $name,
        public readonly Money $amount,
        public readonly UuidInterface $productId,
        public readonly UuidInterface $categoryId,
        public readonly Carbon $payDate
    ) {
        //
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            id: isset($request->uuid) ? Uuid::fromString($request->uuid) : null,
            type: TransactionTypeEnum::from($request->input('type')),
            name: $request->input('name'),
            amount: Money::parseByDecimal(
                $request->input('amount'),
                currency($request->input('currency'))
            ),
            productId: Uuid::fromString($request->input('productId')),
            categoryId: Uuid::fromString($request->input('categoryId')),
            payDate: new Carbon($request->input('payDate')),
        );
    }
}

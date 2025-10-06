<?php

declare(strict_types=1);

namespace App\Http\Requests\Transaction\Dto;

use App\Constants\TransactionTypeEnum;
use App\Contracts\DtoContract;
use Carbon\Carbon;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class TransactionStoreDto implements DtoContract
{
    public function __construct(
        public TransactionTypeEnum $type,
        public string              $name,
        public Money               $amount,
        public UuidInterface       $productId,
        public UuidInterface       $categoryId,
        public Carbon              $payDate,
        public array               $tags = [],
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

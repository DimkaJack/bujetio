<?php

declare(strict_types=1);

namespace App\Dto\Product;

use App\Constants\ProductTypeEnum;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class ProductUpdateDto
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly string $name,
        public readonly ProductTypeEnum $type,
        public readonly Money $startBalance,
        public readonly Money $balance,
    ) {
        //
    }

    public static function fromRequest(Request $request): static
    {
        return new static(
            id: Uuid::fromString($request->uuid),
            name: $request->input('name'),
            type: ProductTypeEnum::from($request->input('type')),
            startBalance: new Money(
                $request->input('startBalanceAmount'),
                $request->input('startBalanceCurrency'),
            ),
            balance: new Money(
                $request->input('balanceAmount'),
                $request->input('balanceCurrency'),
            ),
        );
    }
}

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
        public readonly ?UuidInterface $id,
        public readonly string $name,
        public readonly ProductTypeEnum $type,
        public readonly Money $startBalance,
        public readonly Money $balance,
        public readonly Money $bankLoan,
    ) {
        //
    }

    public static function fromRequest(Request $request): static
    {
        return new static(
            id: isset($request->uuid) ? Uuid::fromString($request->uuid) : null,
            name: $request->input('name'),
            type: ProductTypeEnum::from($request->input('type')),
            startBalance: Money::parseByDecimal(
                $request->input('startBalanceAmount'),
                currency($request->input('startBalanceCurrency')),
            ),
            balance: Money::parseByDecimal(
                $request->input('balanceAmount'),
                currency($request->input('balanceCurrency')),
            ),
            bankLoan: Money::parseByDecimal(
                $request->input('bankLoanAmount'),
                currency($request->input('balanceCurrency')),
            ),
        );
    }
}

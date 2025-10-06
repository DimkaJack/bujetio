<?php

declare(strict_types=1);

namespace App\Http\Requests\Product\Dto;

use App\Constants\ProductTypeEnum;
use App\Contracts\DtoContract;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class ProductUpdateDto implements DtoContract
{
    public function __construct(
        public ?UuidInterface  $id,
        public string          $name,
        public ProductTypeEnum $type,
        public Money           $startBalance,
        public Money           $balance,
        public Money           $bankLoan,
    ) {
        //
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
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

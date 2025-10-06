<?php

namespace App\Dto\Budget;

use App\Contracts\DtoContract;
use Money\Money;

final readonly class BudgetDto implements DtoContract
{
    public function __construct(
        public Money $balance,
        public ?Money $income = null,
        public ?Money $outcome = null,
    ) {
        //
    }
}

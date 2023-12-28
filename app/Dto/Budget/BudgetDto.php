<?php

namespace App\Dto\Budget;

use Money\Money;

final class BudgetDto
{
    public function __construct(
        public readonly Money $balance,
        public readonly ?Money $income = null,
        public readonly ?Money $outcome = null,
    ) {
        //
    }
}

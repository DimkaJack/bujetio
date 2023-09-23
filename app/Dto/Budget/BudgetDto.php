<?php

namespace App\Dto\Budget;

use Money\Money;

final class BudgetDto
{
    public function __construct(
        public readonly Money $income,
        public readonly Money $outcome,
        public readonly Money $balance,
    ) {
        //
    }
}

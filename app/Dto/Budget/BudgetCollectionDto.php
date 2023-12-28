<?php

namespace App\Dto\Budget;

use Money\Money;

final class BudgetCollectionDto
{
    public function __construct(
        public readonly ?BudgetDto $daily = null,
        public readonly ?BudgetDto $weekly = null,
        public readonly ?BudgetDto $monthly = null,
        public readonly ?BudgetDto $yearly = null,
        public readonly ?BudgetDto $total = null,
    ) {
        //
    }
}

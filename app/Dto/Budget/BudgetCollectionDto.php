<?php

namespace App\Dto\Budget;

use App\Contracts\DtoContract;

final readonly class BudgetCollectionDto implements DtoContract
{
    public function __construct(
        public ?BudgetDto $daily = null,
        public ?BudgetDto $weekly = null,
        public ?BudgetDto $monthly = null,
        public ?BudgetDto $yearly = null,
        public ?BudgetDto $total = null,
    ) {
        //
    }
}

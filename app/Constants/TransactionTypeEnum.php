<?php

namespace App\Constants;

enum TransactionTypeEnum: int
{
    case INCOME = 1;
    case OUTCOME = 2;
}

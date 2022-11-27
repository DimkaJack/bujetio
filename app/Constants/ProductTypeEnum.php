<?php

namespace App\Constants;

enum ProductTypeEnum: int
{
    case DEBIT_CARD = 1;
    case CREDIT_CARD = 2;
    case CREDIT_LOAN = 3;
    case ACCOUNT = 4;
}

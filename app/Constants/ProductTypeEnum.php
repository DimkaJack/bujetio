<?php

namespace App\Constants;

enum ProductTypeEnum: int
{
    case DEBIT_CARD = 1;
    case CREDIT_CARD = 2;
    case CREDIT_LOAN = 3;
    case ACCOUNT = 4;

    public function label(): string
    {
        return match($this) {
            ProductTypeEnum::DEBIT_CARD => 'Debit card',
            ProductTypeEnum::CREDIT_CARD => 'Credit card',
            ProductTypeEnum::CREDIT_LOAN => 'Credit',
            ProductTypeEnum::ACCOUNT => 'Account',
        };
    }

    public static function getList(): array
    {
        return array_map(
            fn(ProductTypeEnum $enum) => ['label' => $enum->label(), 'value' => $enum->value],
            ProductTypeEnum::cases()
        );
    }
}

<?php

namespace App\Constants;

enum TransactionTypeEnum: int
{
    case INCOME = 1;
    case OUTCOME = 2;

    public function label(): string
    {
        return match($this) {
            TransactionTypeEnum::INCOME => 'Income',
            TransactionTypeEnum::OUTCOME => 'Outcome',
        };
    }

    public static function getList(): array
    {
        return array_map(
            fn(TransactionTypeEnum $enum) => ['label' => $enum->label(), 'value' => $enum->value],
            TransactionTypeEnum::cases()
        );
    }
}

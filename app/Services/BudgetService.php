<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\TransactionTypeEnum;
use App\Dto\Budget\BudgetDto;
use App\Dto\Transaction\TransactionStoreDto;
use App\Dto\Transaction\TransactionUpdateDto;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

final class BudgetService
{
    public function getBudget(): BudgetDto
    {
        // monthly budget
        $outcomeTransactions = Transaction::whereBetween('pay_date', [now()->startOfMonth(), now()->endOfMonth()])
            ->where('type', TransactionTypeEnum::OUTCOME)
            ->get();
        $incomeTransactions = Transaction::whereBetween('pay_date', [now()->startOfMonth(), now()->endOfMonth()])
            ->where('type', TransactionTypeEnum::INCOME)
            ->get();

        // @todo sum by currency
        $outcome = $outcomeTransactions->sum('amount_amount');
        $income = $incomeTransactions->sum('amount_amount');

        // @todo add currency conversion
        return new BudgetDto(
            income: new Money($income, currency('RUB')),
            outcome: new Money($outcome, currency('RUB')),
            balance: new Money($income - $outcome, currency('RUB'))
        );
    }
}
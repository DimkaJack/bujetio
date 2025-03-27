<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\TransactionTypeEnum;
use App\Dto\Budget\BudgetCollectionDto;
use App\Dto\Budget\BudgetDto;
use App\Models\Product;
use App\Models\Transaction;
use Money\Money;

final class BudgetService
{
    public function getBudget(): BudgetCollectionDto
    {
        return new BudgetCollectionDto(
            monthly: $this->getBudgetMonthly(),
            total: $this->getBudgetTotal(),
        );
    }

    public function getBudgetMonthly(): BudgetDto
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
            balance: new Money($income - $outcome, currency('RUB')),
            income: new Money($income, currency('RUB')),
            outcome: new Money($outcome, currency('RUB')),
        );
    }

    public function getBudgetTotal(): BudgetDto
    {
        $products = Product::all();

        $currentBalance = $products->sum('balance_amount');
        $currentDebt = $products->sum('bank_loan_amount');

        // @todo add currency conversion
        return new BudgetDto(
            balance: new Money($currentBalance - $currentDebt, currency('RUB')),
            income: new Money($currentBalance, currency('RUB')),
            outcome: new Money($currentDebt, currency('RUB')),
        );
    }
}

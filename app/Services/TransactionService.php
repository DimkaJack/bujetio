<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

final class TransactionService
{
    public function getList(): Collection
    {
        $response = Transaction::all();
        return $response;
    }
}

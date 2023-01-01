<?php

declare(strict_types=1);

namespace App\Http\Controllers\Inertia;

use App\Dto\Transaction\TransactionStoreDto;
use App\Dto\Transaction\TransactionUpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
    ) {
        //
    }

    public function index(): Response
    {
        return Inertia::render('Transaction/Index', [
            'transactions' => TransactionResource::collection($this->transactionService->getList())
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Transaction/Create');
    }

    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        $dto = TransactionStoreDto::fromRequest($request);
        $this->transactionService->store($dto);

        return redirect()->route('transactions.index');
    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function edit(Transaction $transaction): Response
    {
        return Inertia::render('Transaction/Edit', compact('transaction'));
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction): RedirectResponse
    {
        $dto = TransactionUpdateDto::fromRequest($request);
        $this->transactionService->updateByTransaction($dto, $transaction);

        return redirect()->route('transactions.index');
    }

    public function destroy(Transaction $transaction): RedirectResponse
    {
        $this->transactionService->deleteByTransaction($transaction);

        return redirect()->route('transactions.index');
    }
}

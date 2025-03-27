<?php

declare(strict_types=1);

namespace App\Http\Controllers\Inertia;

use App\Constants\TransactionTypeEnum;
use App\Dto\Transaction\TransactionStoreDto;
use App\Dto\Transaction\TransactionUpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Http\Resources\Transaction\GetTransactionResource;
use App\Models\Transaction;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\TagService;
use App\Services\TransactionService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final class TransactionController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService,
        private readonly ProductService $productService,
        private readonly TransactionService $transactionService,
        private readonly TagService $tagService,
    ) {
        //
    }

    public function index(): Response
    {
        return Inertia::render('Transaction/Index', [
            'transactions' => GetTransactionResource::collection($this->transactionService->getList())
        ]);
    }

    public function create(): Response
    {
        $categories = $this->categoryService->getList();
        $products = $this->productService->getList();
        $tags = $this->tagService->getList();
        $types = TransactionTypeEnum::getList();

        return Inertia::render(
            'Transaction/Create',
            compact(
                'categories',
                'products',
                'tags',
                'types',
            )
        );
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
        $categories = $this->categoryService->getList();
        $products = $this->productService->getList();
        $transactionResource = new GetTransactionResource($transaction);
        $tags = $this->tagService->getList();
        $types = TransactionTypeEnum::getList();

        return Inertia::render(
            'Transaction/Edit',
            [
                'categories' => $categories,
                'products' => $products,
                'transaction' => $transactionResource,
                'tags' => $tags,
                'types' => $types,
            ]
        );
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

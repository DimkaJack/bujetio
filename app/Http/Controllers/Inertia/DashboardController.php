<?php

declare(strict_types=1);

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\GetProductResource;
use App\Http\Resources\Transaction\GetTransactionResource;
use App\Services\ProductService;
use App\Services\TransactionService;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly ProductService $productService,
    ) {
        //
    }

    public function __invoke(): Response
    {
        return Inertia::render('Dashboard', [
            'transactions' => GetTransactionResource::collection($this->transactionService->filtered(5)),
            'products' => GetProductResource::collection($this->productService->getList())
        ]);
    }
}

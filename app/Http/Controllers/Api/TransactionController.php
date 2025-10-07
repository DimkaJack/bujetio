<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\Dto\TransactionStoreDto;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Http\Resources\Transaction\GetTransactionResource;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

final class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
    ) {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return GetTransactionResource::collection($this->transactionService->getList());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        //@todo
        return response()->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTransactionRequest $request
     * @return \App\Http\Resources\Transaction\GetTransactionResource
     */
    public function store(StoreTransactionRequest $request): GetTransactionResource
    {
        return new GetTransactionResource(
            $this->transactionService->store(
                dto: $request->getDto(),
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function show(Transaction $transaction): JsonResponse
    {
        //@todo
        return response()->json();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function edit(Transaction $transaction): JsonResponse
    {
        //@todo
        return response()->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTransactionRequest $request
     * @param Transaction $transaction
     * @return Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction): GetTransactionResource
    {
        return new GetTransactionResource(
            $this->transactionService->update(
                dto: $request->getDto(),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        //@todo
        return response()->json();
    }
}

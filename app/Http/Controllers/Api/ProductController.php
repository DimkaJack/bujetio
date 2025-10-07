<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\GetProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService,
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
        return GetProductResource::collection($this->productService->getList());
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
     * @param StoreProductRequest $request
     * @return GetProductResource
     */
    public function store(StoreProductRequest $request): GetProductResource
    {
        return new GetProductResource(
            $this->productService->store(
                dto: $request->getDto(),
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        //@todo
        return response()->json();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function edit(Product $product): JsonResponse
    {
        //@todo
        return response()->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @return \App\Http\Resources\Product\GetProductResource
     */
    public function update(UpdateProductRequest $request): GetProductResource
    {
        return new GetProductResource(
            $this->productService->update(
                dto: $request->getDto(),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        //@todo fix to validation
        if (
            !empty($request->uuid)
            && Uuid::isValid($request->uuid)
            && $this->productService->delete(Uuid::fromString($request->uuid))
        ) {
            return response()->json(status: Response::HTTP_NO_CONTENT);
        }

        return response()->json(status: Response::HTTP_BAD_REQUEST);
    }
}

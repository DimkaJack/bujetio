<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\GetProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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
     * @return bool
     */
    public function destroy(Request $request): bool
    {
        //@todo fix to validation
        if (!empty($request->uuid) && Uuid::isValid($request->uuid)) {
            return $this->productService->delete(Uuid::fromString($request->uuid));
        }

        return false;
    }
}

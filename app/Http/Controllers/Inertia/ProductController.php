<?php

namespace App\Http\Controllers\Inertia;

use App\Dto\Product\ProductStoreDto;
use App\Dto\Product\ProductUpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
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
        return ProductResource::collection($this->productService->getList());
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
     * @return ProductResource
     */
    public function store(StoreProductRequest $request): ProductResource
    {
        $dto = ProductStoreDto::fromRequest($request);

        return new ProductResource($this->productService->store($dto));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
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
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request): ProductResource
    {
        $dto = ProductUpdateDto::fromRequest($request);

        return new ProductResource($this->productService->update($dto));
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

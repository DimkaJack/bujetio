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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService,
    ) {
        //
    }

    public function index(): Response
    {
        return Inertia::render('Product/Index', [
            'products' => ProductResource::collection($this->productService->getList())
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return ProductResource
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $dto = ProductStoreDto::fromRequest($request);
        $this->productService->store($dto);

        return redirect()->route('products.index');
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
    public function edit(Product $product): Response
    {
        return Inertia::render('Product/Edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $dto = ProductUpdateDto::fromRequest($request);
        $this->productService->updateByProduct($dto, $product);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->productService->deleteByProduct($product);

        return redirect()->route('products.index');
    }
}

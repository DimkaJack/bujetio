<?php

namespace App\Http\Controllers\Inertia;

use App\Constants\ProductTypeEnum;
use App\Dto\Product\ProductStoreDto;
use App\Dto\Product\ProductUpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\GetProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

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
            'products' => GetProductResource::collection($this->productService->getList())
        ]);
    }

    public function create(): Response
    {
        $types = ProductTypeEnum::getList();

        return Inertia::render('Product/Create', compact('types'));
    }

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

    public function edit(Product $product): Response
    {
        $types = ProductTypeEnum::getList();
        $productResource = new GetProductResource($product);

        return Inertia::render(
            'Product/Edit',
            [
                'product' => $productResource,
                'types' => $types,
            ]
        );
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

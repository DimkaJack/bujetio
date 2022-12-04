<?php

declare(strict_types=1);

namespace App\Http\Controllers\Inertia;

use App\Dto\Category\CategoryStoreDto;
use App\Dto\Category\CategoryUpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService,
    ) {
        //
    }

    public function index(): Response
    {
        return Inertia::render('Category/Index', [
            'categories' => CategoryResource::collection($this->categoryService->getList())
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Category/Create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $dto = CategoryStoreDto::fromRequest($request);
        $this->categoryService->store($dto);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category): Response
    {
        return Inertia::render('Category/Edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $dto = CategoryUpdateDto::fromRequest($request);
        $this->categoryService->updateByCategory($dto, $category);

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->categoryService->deleteByCategory($category);

        return redirect()->route('categories.index');
    }
}

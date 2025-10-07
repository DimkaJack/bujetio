<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService,
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
        return CategoryResource::collection($this->categoryService->getList());
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
     * @param StoreCategoryRequest $request
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request): CategoryResource
    {
        return new CategoryResource(
            $this->categoryService->store(
                dto: $request->getDto(),
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        //@todo
        return response()->json();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function edit(Category $category): JsonResponse
    {
        //@todo
        return response()->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(UpdateCategoryRequest $request): CategoryResource
    {
        return new CategoryResource(
            $this->categoryService->update(
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
            && $this->categoryService->delete(Uuid::fromString($request->uuid))
        ) {
            return response()->json(status: Response::HTTP_NO_CONTENT);
        }

        return response()->json(status: Response::HTTP_BAD_REQUEST);
    }
}

<?php

namespace App\Http\Controllers\Inertia;

use App\Dto\Tag\TagStoreDto;
use App\Dto\Tag\TagUpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TagController extends Controller
{
    public function __construct(
        private readonly TagService $tagService,
    ) {
        //
    }

    public function index(): Response
    {
        return Inertia::render('Tag/Index', [
            'tags' => TagResource::collection($this->tagService->getList())
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Tag/Create');
    }

    public function store(StoreTagRequest $request): RedirectResponse
    {
        $dto = TagStoreDto::fromRequest($request);
        $this->tagService->store($dto);

        return redirect()->route('tags.index');
    }

    public function show(Tag $transaction)
    {
        //
    }

    public function edit(Tag $tag): Response
    {
        //@todo send resource to response
        return Inertia::render('Tag/Edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag): RedirectResponse
    {
        $dto = TagUpdateDto::fromRequest($request);
        $this->tagService->updateByTag($dto, $tag);

        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $this->tagService->deleteByTag($tag);

        return redirect()->route('tags.index');
    }
}

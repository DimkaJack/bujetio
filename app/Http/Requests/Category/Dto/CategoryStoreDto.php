<?php

declare(strict_types=1);

namespace App\Http\Requests\Category\Dto;

use App\Contracts\DtoContract;
use App\Http\Requests\Category\StoreCategoryRequest;

final readonly class CategoryStoreDto implements DtoContract
{
    public function __construct(
        public string $name,
        public string $color,
    ) {
        //
    }

    public static function fromRequest(StoreCategoryRequest $request): self
    {
        return new self(
            name: $request->input('name'),
            color: $request->input('color'),
        );
    }
}

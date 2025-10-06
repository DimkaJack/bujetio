<?php

declare(strict_types=1);

namespace App\Http\Requests\Category\Dto;

use App\Contracts\DtoContract;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class CategoryUpdateDto implements DtoContract
{
    public function __construct(
        public ?UuidInterface $id,
        public string $name,
        public string $color,
    ) {
        //
    }

    public static function fromRequest(UpdateCategoryRequest $request): self
    {
        return new self(
            id: isset($request->uuid) ? Uuid::fromString($request->uuid) : null,
            name: $request->input('name'),
            color:$request->input('color'),
        );
    }
}

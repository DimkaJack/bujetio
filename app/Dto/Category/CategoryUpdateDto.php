<?php

declare(strict_types=1);

namespace App\Dto\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class CategoryUpdateDto
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly string $name,
        public readonly string $color,
    ) {
        //
    }

    public static function fromRequest(Request $request): static
    {
        return new static(
            id: Uuid::fromString($request->uuid),
            name: $request->input('name'),
            color:$request->input('color'),
        );
    }
}

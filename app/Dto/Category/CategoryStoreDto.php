<?php

declare(strict_types=1);

namespace App\Dto\Category;

use Illuminate\Http\Request;

final class CategoryStoreDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $color,
    ) {
        //
    }

    public static function fromRequest(Request $request): static
    {
        return new static(
            name: $request->input('name'),
            color: $request->input('color'),
        );
    }
}

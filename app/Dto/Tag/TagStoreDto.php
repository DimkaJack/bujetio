<?php

declare(strict_types=1);

namespace App\Dto\Tag;

use Illuminate\Http\Request;

final class TagStoreDto
{
    public function __construct(
        public readonly string $name,
    ) {
        //
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->input('name'),
        );
    }
}

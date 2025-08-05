<?php

declare(strict_types=1);

namespace App\Http\Requests\Tag\Dto;

use App\Contracts\DtoContract;
use Illuminate\Http\Request;

final readonly class TagStoreDto implements DtoContract
{
    public function __construct(
        public string $name,
        public string $color,
    ) {
        //
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->input('name'),
            color: $request->input('color'),
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Dto\Tag;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class TagUpdateDto
{
    public function __construct(
        public readonly ?UuidInterface $id,
        public readonly string $name,
    ) {
        //
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            id: isset($request->uuid) ? Uuid::fromString($request->uuid) : null,
            name: $request->input('name'),
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Tag\TagStoreDto;
use App\Dto\Tag\TagUpdateDto;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\UuidInterface;

final class TagService
{
    public function getList(): Collection
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->tags;
    }

    public function store(TagStoreDto $dto): Tag
    {
        $tag = new Tag();
        $tag->name = $dto->name;
        $tag->user()->associate(Auth::user());
        $tag->save();

        return $tag;
    }

    public function update(TagUpdateDto $dto): Tag
    {
        $tag = Tag::find($dto->id);
        $tag->name = $dto->name;
        $tag->save();

        return $tag;
    }

    public function updateByTag(TagUpdateDto $dto, Tag $tag): Tag
    {
        $tag->name = $dto->name;
        $tag->save();

        return $tag;
    }

    public function delete(UuidInterface $id): bool
    {
        $tag = Tag::find($id);

        return $this->deleteByTag($tag);
    }

    public function deleteByTag(Tag $tag): bool
    {
        //@todo add transaction
        $tag->delete();

        return true;
    }
}

<?php

namespace App\Domain\PostComment\ValueObjects;

class PostId
{
    /**
     * @param string $id
     */
    private function __construct(public readonly string $id)
    {
    }

    /**
     * @param string $id
     * @return PostId
     */
    public static function fromString(string $id): PostId
    {
        return new self($id);
    }
}

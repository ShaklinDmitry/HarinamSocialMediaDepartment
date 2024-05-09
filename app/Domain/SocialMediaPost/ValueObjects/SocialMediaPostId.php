<?php

namespace App\Domain\SocialMediaPost\ValueObjects;

class SocialMediaPostId
{

    /**
     * @param string $postId
     */
    private function __construct(public readonly string $postId)
    {
    }

    /**
     * @param string $postId
     * @return SocialMediaPostId
     */
    public static function fromString(string $postId): SocialMediaPostId
    {
        return new self($postId);
    }
}

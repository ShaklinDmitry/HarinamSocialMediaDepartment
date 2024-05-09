<?php

namespace App\Domain\PostComment\ValueObjects;

class PostCommentText
{
    /**
     * @param string $text
     */
    private function __construct(public readonly string $text)
    {
    }

    /**
     * @param string $text
     * @return PostCommentText
     */
    public static function fromString(string $text): PostCommentText
    {
        return new self($text);
    }
}

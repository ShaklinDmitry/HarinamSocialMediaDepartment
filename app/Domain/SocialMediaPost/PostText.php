<?php

namespace App\Domain\SocialMediaPost;

final class PostText
{

    /**
     * @param string $text
     */
    public function __construct(public readonly string $text)
    {
    }

    /**
     * @param string $text
     * @return PostText
     */
    public static function fromString(string $text): PostText
    {
        return new self($text);
    }


}

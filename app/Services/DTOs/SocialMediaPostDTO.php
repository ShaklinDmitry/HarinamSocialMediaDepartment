<?php

namespace App\Services\DTOs;

class SocialMediaPostDTO
{
    /**
     * @param string $socialMediaPostId
     * @param string $socialMediaName
     */
    private function __construct(public readonly string $socialMediaPostId, public readonly string $socialMediaName)
    {
    }

    /**
     * @param string $socialMediaPostId
     * @param string $socialMediaName
     * @return static
     */
    public static function create(string $socialMediaPostId, string $socialMediaName)
    {
        return new static($socialMediaPostId, $socialMediaName);
    }
}

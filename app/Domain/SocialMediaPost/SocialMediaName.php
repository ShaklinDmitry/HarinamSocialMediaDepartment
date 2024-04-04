<?php

namespace App\Domain\SocialMediaPost;

final class SocialMediaName
{
    /**
     * @param string $socialMediaName
     */
    private function __construct(public readonly string $socialMediaName)
    {
    }

    /**
     * @param string $socialMediaName
     * @return SocialMediaName
     */
    public static function fromString(string $socialMediaName): SocialMediaName
    {
        return new self($socialMediaName);
    }
}

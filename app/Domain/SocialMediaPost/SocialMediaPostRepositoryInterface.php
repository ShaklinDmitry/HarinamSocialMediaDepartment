<?php

namespace App\Domain\SocialMediaPost;

use App\Domain\SocialMediaPost\ValueObjects\SocialMediaPostId;

interface SocialMediaPostRepositoryInterface
{
    /**
     * @param SocialMediaPost $socialMediaPost
     * @return mixed
     */
    public function addSocialMediaPost(SocialMediaPost $socialMediaPost): void;

    /**
     * @param SocialMediaPostId $socialMediaPostId
     * @return SocialMediaPost
     */
    public function getSocialMediaPost(SocialMediaPostId $socialMediaPostId): SocialMediaPost;

    /**
     * @return SocialMediaPostId
     */
    public function nextIdentity(): SocialMediaPostId;
}

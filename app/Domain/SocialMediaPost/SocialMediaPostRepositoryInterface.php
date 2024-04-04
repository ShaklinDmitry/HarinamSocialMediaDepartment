<?php

namespace App\Domain\SocialMediaPost;

interface SocialMediaPostRepositoryInterface
{
    /**
     * @param SocialMediaPost $socialMediaPost
     * @return mixed
     */
    public function addSocialMediaPost(SocialMediaPost $socialMediaPost): void;

    /**
     * @return SocialMediaPostId
     */
    public function nextIdentity(): SocialMediaPostId;
}

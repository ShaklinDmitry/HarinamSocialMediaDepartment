<?php

namespace App\Repositories;

use App\Domain\SocialMediaPost\SocialMediaPost;
use App\Domain\SocialMediaPost\SocialMediaPostId;
use App\Domain\SocialMediaPost\SocialMediaPostRepositoryInterface;
use App\Models\Post;
use Ramsey\Uuid\Uuid;

class SocialMediaPostRepository implements SocialMediaPostRepositoryInterface
{
    /**
     * @param SocialMediaPost $socialMediaPost
     * @return void
     */
    public function addSocialMediaPost(SocialMediaPost $socialMediaPost): void
    {
        Post::create([
            'id' =>  $socialMediaPost->socialMediaPostId->postId,
            'social_media_name' => $socialMediaPost->socialMediaName->socialMediaName,
            'post_text' => $socialMediaPost->postText->text
        ]);
    }

    /**
     * @return SocialMediaPostId
     */
    public function nextIdentity(): SocialMediaPostId
    {
        return SocialMediaPostId::fromString(Uuid::uuid7());
    }
}

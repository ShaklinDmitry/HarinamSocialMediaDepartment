<?php

namespace App\Repositories;

use App\Domain\SocialMediaPost\SocialMediaPost;
use App\Domain\SocialMediaPost\SocialMediaPostRepositoryInterface;
use App\Domain\SocialMediaPost\ValueObjects\SocialMediaPostId;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @param SocialMediaPostId $socialMediaPostId
     * @return SocialMediaPost
     */
    public function getSocialMediaPost(SocialMediaPostId $socialMediaPostId): SocialMediaPost
    {
        $post = Post::where('id' , $socialMediaPostId)->get();

        if($post->isEmpty()){
            return new ModelNotFoundException();
        }

        return new SocialMediaPost($post->id, $post->social_media_name, $post->post_text);
    }

    /**
     * @return SocialMediaPostId
     */
    public function nextIdentity(): SocialMediaPostId
    {
        return SocialMediaPostId::fromString(Uuid::uuid7());
    }
}

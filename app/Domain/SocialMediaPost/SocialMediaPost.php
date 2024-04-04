<?php

namespace App\Domain\SocialMediaPost;

class SocialMediaPost
{

    /**
     * @param SocialMediaPostId $socialMediaPostId
     * @param SocialMediaName $socialMediaName
     * @param PostText $postText
     */
    public function __construct(public readonly SocialMediaPostId $socialMediaPostId, public readonly SocialMediaName $socialMediaName, public readonly PostText $postText)
    {

    }
}

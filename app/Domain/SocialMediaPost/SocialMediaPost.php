<?php

namespace App\Domain\SocialMediaPost;

use App\Domain\SocialMediaPost\ValueObjects\PostText;
use App\Domain\SocialMediaPost\ValueObjects\SocialMediaName;
use App\Domain\SocialMediaPost\ValueObjects\SocialMediaPostId;

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

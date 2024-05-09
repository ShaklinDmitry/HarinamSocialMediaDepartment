<?php

namespace App\Services;

use App\Services\DTOs\SocialMediaPostCommentDTO;
use App\Services\DTOs\SocialMediaPostDTO;

interface PostServiceInterface
{
    /**
     * @param string $socialMediaName
     * @param string $postText
     * @return SocialMediaPostDTO
     */
    public function addSocialMediaPost(string $socialMediaName, string $postText): SocialMediaPostDTO;

    /**
     * @param string $postId
     * @param string $commentText
     * @return SocialMediaPostCommentDTO
     */
    public function addSocialMediaPostComment(string $postId, string $commentText): SocialMediaPostCommentDTO;

}

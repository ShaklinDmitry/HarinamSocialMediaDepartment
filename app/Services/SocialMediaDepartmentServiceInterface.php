<?php

namespace App\Services;

use App\Services\DTOs\SocialMediaPostDTO;

interface SocialMediaDepartmentServiceInterface
{
    /**
     * @param string $socialMediaName
     * @param string $postText
     * @return SocialMediaPostDTO
     */
    public function addSocialMediaPost(string $socialMediaName, string $postText): SocialMediaPostDTO;
}

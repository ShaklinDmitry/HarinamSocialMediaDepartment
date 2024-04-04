<?php

namespace App\Services;

use App\Domain\SocialMediaPost\PostText;
use App\Domain\SocialMediaPost\SocialMediaName;
use App\Domain\SocialMediaPost\SocialMediaPost;
use App\Domain\SocialMediaPost\SocialMediaPostId;
use App\Domain\SocialMediaPost\SocialMediaPostRepositoryInterface;
use App\Services\DTOs\SocialMediaPostDTO;

class SocialMediaDepartmentService implements SocialMediaDepartmentServiceInterface
{

    /**
     * @param SocialMediaPostRepositoryInterface $socialMediaPostRepository
     */
    public function __construct(private SocialMediaPostRepositoryInterface $socialMediaPostRepository)
    {
    }

    /**
     * @param string $socialMediaName
     * @param string $postText
     * @return SocialMediaPostDTO
     */
    public function addSocialMediaPost(string $socialMediaName, string $postText): SocialMediaPostDTO
    {
        $socialMediaPost = new SocialMediaPost($this->socialMediaPostRepository->nextIdentity(),
                                               SocialMediaName::fromString($socialMediaName),
                                               PostText::fromString($postText));

        $this->socialMediaPostRepository->addSocialMediaPost($socialMediaPost);

        return SocialMediaPostDTO::create($socialMediaPost->socialMediaPostId->postId,
                                        $socialMediaPost->socialMediaName->socialMediaName);

    }

}

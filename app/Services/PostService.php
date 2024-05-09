<?php

namespace App\Services;

use App\Domain\PostComment\PostComment;
use App\Domain\PostComment\PostCommentRepositoryInterface;
use App\Domain\PostComment\ValueObjects\PostCommentText;
use App\Domain\PostComment\ValueObjects\PostId;
use App\Domain\SocialMediaPost\SocialMediaPost;
use App\Domain\SocialMediaPost\SocialMediaPostRepositoryInterface;
use App\Domain\SocialMediaPost\ValueObjects\PostText;
use App\Domain\SocialMediaPost\ValueObjects\SocialMediaName;
use App\Exceptions\NumberPostCommentsExceededException;
use App\Services\DTOs\SocialMediaPostCommentDTO;
use App\Services\DTOs\SocialMediaPostDTO;

class PostService implements PostServiceInterface
{

    const POST_COMMENTS_MAX_COUNT = 5;

    /**
     * @param SocialMediaPostRepositoryInterface $socialMediaPostRepository
     * @param PostCommentRepositoryInterface $postCommentRepository
     */
    public function __construct(private SocialMediaPostRepositoryInterface $socialMediaPostRepository,
                                private PostCommentRepositoryInterface $postCommentRepository)
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

    /**
     * @param string $postId
     * @param string $commentText
     * @return SocialMediaPostCommentDTO
     * @throws \Exception
     */
    public function addSocialMediaPostComment(string $postId, string $commentText): SocialMediaPostCommentDTO
    {
        $commentsCount = $this->postCommentRepository->getCommentsCountByPostId($postId);

        if ($commentsCount >= self::POST_COMMENTS_MAX_COUNT)
        {
            throw new NumberPostCommentsExceededException('The number of comments on the post has been exceeded');
        }

        $postComment = PostComment::create(PostCommentText::fromString($commentText), PostId::fromString($postId));

        $comment = $this->postCommentRepository->addComment($postComment);

        return SocialMediaPostCommentDTO::create($comment->id, $comment->text, $comment->post_id);
    }

}

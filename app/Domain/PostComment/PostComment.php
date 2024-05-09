<?php

namespace App\Domain\PostComment;

use App\Domain\PostComment\ValueObjects\PostCommentText;
use App\Domain\PostComment\ValueObjects\PostId;

class PostComment
{

    /**
     * @param PostCommentText $commentText
     * @param PostId $postId
     */
    private function __construct(public readonly PostCommentText $commentText, public readonly PostId $postId)
    {

    }

    /**
     * @param PostCommentText $commentText
     * @param PostId $postId
     * @return PostComment
     */
    public static function create(PostCommentText $commentText, PostId $postId): PostComment
    {
        return new self($commentText, $postId);
    }
}

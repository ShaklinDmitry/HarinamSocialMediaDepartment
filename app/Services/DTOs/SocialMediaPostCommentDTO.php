<?php

namespace App\Services\DTOs;

class SocialMediaPostCommentDTO
{

    /**
     * @param int $commentId
     * @param string $commentText
     * @param string $postId
     */
    private function __construct(public readonly int $commentId, public readonly string $commentText,
                                public readonly string $postId)
    {
    }


    /**
     * @param int $commentId
     * @param string $commentText
     * @param string $postId
     * @return static
     */
    public static function create(int $commentId, string $commentText,
                                  string $postId)
    {
        return new static($commentId, $commentText, $postId);
    }
}

<?php

namespace App\Domain\PostComment;

interface PostCommentRepositoryInterface
{
    /**
     * @param PostComment $postComment
     * @return mixed
     */
    public function addComment(PostComment $postComment);

    /**
     * @param string $postId
     * @return int
     */
    public function getCommentsCountByPostId(string $postId): int;

}

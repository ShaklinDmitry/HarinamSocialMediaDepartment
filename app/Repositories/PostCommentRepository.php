<?php

namespace App\Repositories;

use App\Domain\PostComment\PostComment;
use App\Domain\PostComment\PostCommentRepositoryInterface;
use App\Models\PostComments;
use Illuminate\Support\Facades\DB;

class PostCommentRepository implements PostCommentRepositoryInterface
{
    /**
     * @param PostComment $postComment
     * @return mixed|void
     */
    public function addComment(PostComment $postComment)
    {
        $comment = PostComments::create([
            'text' => $postComment->commentText->text,
            'post_id' => $postComment->postId->id
        ]);

        return $comment;
    }

    /**
     * @param string $postId
     * @return int
     */
    public function getCommentsCountByPostId(string $postId): int
    {
        $postCommentsCount = PostComments::where('post_id', $postId)->count();

        return $postCommentsCount;
    }
}

<?php

namespace Tests\Feature;

use App\Models\PostComments;
use App\Repositories\PostCommentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class GetPostCommentsCountTest extends TestCase
{
//    use RefreshDatabase;
//
//    public function test_get_post_comments_count(){
//        $postId = Uuid::uuid7();
//        $originalCommentsCount = 5;
//
//        PostComments::factory()->count($originalCommentsCount)->create([
//            'post_id' => $postId
//        ]);
//
//        $postCommentRepository = app(PostCommentRepository::class);
//
//        $commentsCount = $postCommentRepository->getCommentsCountByPostId($postId);
//
//        $this->assertSame($originalCommentsCount, $commentsCount);
//    }

}

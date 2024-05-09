<?php

namespace Tests\Feature;

use App\Exceptions\NumberPostCommentsExceededException;
use App\Models\PostComments;
use App\Services\PostServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class AddPostCommentTest extends TestCase
{

    use RefreshDatabase;

    private PostServiceInterface $postService;

    protected function setUp():void
    {
        parent::setUp();

        $this->postService = app(PostServiceInterface::class);
    }

    public function test_add_post_comment_with_exceeded_count(): void
    {
        $this->expectException(NumberPostCommentsExceededException::class);

        $commentsCount = 7;
        $postId = Uuid::uuid7();

        PostComments::factory()->count($commentsCount)->create([
            'post_id' => $postId
        ]);

        $postService = app(PostServiceInterface::class);

        $postService->addSocialMediaPostComment($postId, fake()->text(15));

    }

    public function test_add_post_comment(): void
    {
        $postId = Uuid::uuid7()->toString();
        $text = fake()->text(15);

        $postCommentDTO = $this->postService->addSocialMediaPostComment($postId, $text);

        $this->assertSame($postId , $postCommentDTO->postId);
        $this->assertSame($text, $postCommentDTO->commentText);
    }
}

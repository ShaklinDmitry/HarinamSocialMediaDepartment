<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddSocialMediaPostTest extends TestCase
{

    public function test_add_social_media_post_api(): void
    {
        $socailMediaName = 'Vk';
        $postText = 'Test post text';

        $response = $this->post('/api/post',
            [
                'socialMediaName' => $socailMediaName,
                'postText' => $postText,
            ],
            ["Accept" => "application/json"]);

        $response->assertJson(
            [
                "data" => [
                    "message" => "Post was added.",
                    "post" => [
                        'socialMediaName' => $socailMediaName,
                    ]
                ]
            ]
        );

        $this->assertDatabaseHas('posts',[
            'social_media_name' => $socailMediaName,
            'post_text' => $postText
        ]);

    }
}

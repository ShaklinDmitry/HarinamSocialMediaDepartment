<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialMediaPostRequest;
use App\Services\DTOs\SocialMediaPostDTO;
use App\Services\PostServiceInterface;
use Illuminate\Http\Request;

class SocialMediaPostController extends Controller
{
    /**
     * @param PostServiceInterface $socialMediaDepartmentService
     */
    public function __construct(private PostServiceInterface $socialMediaDepartmentService)
    {
    }

    /**
     * @param SocialMediaPostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPost(SocialMediaPostRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails())
        {
            return response()->json($request->validator->messages(), 400);
        }

        $socialMediaPostDTO = $this->socialMediaDepartmentService->addSocialMediaPost($request->socialMediaName, $request->postText);

        $responseData = [
            "data" => [
                "message" => "Post was added.",
                "post" => [
                    'socialMediaName' => $socialMediaPostDTO->socialMediaName,
                    'socialMediaPostId' => $socialMediaPostDTO->socialMediaPostId
                ]
            ]
        ];

        return response()->json($responseData, 201);
    }
}

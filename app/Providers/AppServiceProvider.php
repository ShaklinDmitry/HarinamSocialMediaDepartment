<?php

namespace App\Providers;

use App\Consumers\AddedVideoConsumer;
use App\Consumers\AddedVideoConsumerInterface;
use App\Domain\AddedVideo\AddedVideoRepositoryInterface;
use App\Domain\PostComment\PostCommentRepositoryInterface;
use App\Domain\SocialMediaPost\SocialMediaPostRepositoryInterface;
use App\Repositories\AddedVideoRepository;
use App\Repositories\PostCommentRepository;
use App\Repositories\SocialMediaPostRepository;
use App\Services\AddedVideoService;
use App\Services\AddedVideoServiceInterface;
use App\Services\PostService;
use App\Services\PostServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(SocialMediaPostRepositoryInterface::class, function (){
           return new SocialMediaPostRepository();
        });


        $this->app->bind(AddedVideoRepositoryInterface::class, function (){
            return new AddedVideoRepository();
        });

        $this->app->bind(AddedVideoServiceInterface::class, function (){
            return new AddedVideoService(app(AddedVideoRepositoryInterface::class));
        });

        $this->app->bind(AddedVideoConsumerInterface::class, function (){
            return new AddedVideoConsumer(app(AddedVideoServiceInterface::class));
        });

        $this->app->bind(PostCommentRepositoryInterface::class, function (){
            return new PostCommentRepository();
        });

        $this->app->bind(PostServiceInterface::class, function (){
            return new PostService(app(SocialMediaPostRepositoryInterface::class),
                                    app(PostCommentRepositoryInterface::class));
        });
    }
}

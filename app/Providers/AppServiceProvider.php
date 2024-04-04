<?php

namespace App\Providers;

use App\Domain\SocialMediaPost\SocialMediaPostRepositoryInterface;
use App\Repositories\SocialMediaPostRepository;
use App\Services\SocialMediaDepartmentService;
use App\Services\SocialMediaDepartmentServiceInterface;
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

        $this->app->bind(SocialMediaDepartmentServiceInterface::class, function (){
            return new SocialMediaDepartmentService(app(SocialMediaPostRepositoryInterface::class));
        });
    }
}

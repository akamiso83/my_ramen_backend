<?php

namespace App\Providers;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 以下にDIの設定を記載
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

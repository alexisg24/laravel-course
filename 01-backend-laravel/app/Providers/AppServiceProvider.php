<?php

namespace App\Providers;

use App\Business\Interfaces\MessageServiceInterface;
use App\Business\Services\EncryptService;
use App\Business\Services\HiService;
use App\Business\Services\HiUserService;
use App\Business\Services\SingletonService;
use App\Business\Services\UserService;
use App\Http\Controllers\InfoController;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MessageServiceInterface::class, HiUserService::class);
        $this->app->bind(EncryptService::class, function () {
            return new EncryptService(env('ENCRYPT_KEY'));
        });
        // $this->app->bind(UserService::class, function () {
        //     return new UserService($this->app->make(EncryptService::class));
        // });

        $this->app->when(InfoController::class)
            ->needs(MessageServiceInterface::class)
            ->give(HiService::class);

        $this->app->singleton(SingletonService::class, function ($app) {
            return new SingletonService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

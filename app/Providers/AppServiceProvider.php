<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\CreateNewUser;
use Laravel\Fortify\Contracts\LoginViewResponse as LoginViewResponseContract;
use App\Http\Responses\LoginViewResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(CreatesNewUsers::class, CreateNewUser::class);

        // ログイン画面表示時のレスポンスをバインド
        $this->app->bind(LoginViewResponseContract::class, LoginViewResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

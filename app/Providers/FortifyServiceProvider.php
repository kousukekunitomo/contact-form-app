<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Responses\LogoutResponse;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\LoginViewResponse as LoginViewResponseContract;
use Laravel\Fortify\Contracts\RegisterViewResponse as RegisterViewResponseContract;
use App\Http\Responses\LoginViewResponse;
use App\Http\Responses\RegisterViewResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(LoginViewResponseContract::class, LoginViewResponse::class);
        $this->app->singleton(RegisterViewResponseContract::class, RegisterViewResponse::class);
        $this->app->singleton(LogoutResponseContract::class, LogoutResponse::class);
    }

    public function boot()
    {
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        // Fortifyのユーザー作成ロジック
        Fortify::createUsersUsing(CreateNewUser::class);

        // 認証処理
        Fortify::authenticateUsing(function (Request $request) {
            Validator::make(
                $request->all(),
                (new LoginRequest())->rules(),
                (new LoginRequest())->messages()
            )->validate();

            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
            return null;
        });
    }
}

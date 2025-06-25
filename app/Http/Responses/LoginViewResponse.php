<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginViewResponse as LoginViewResponseContract;

class LoginViewResponse implements LoginViewResponseContract
{
    public function toResponse($request)
    {
        return Auth::check()
            ? redirect('/admin')
            : view('auth.login');
    }
}

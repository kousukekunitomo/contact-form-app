<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterViewResponse as RegisterViewResponseContract;

class RegisterViewResponse implements RegisterViewResponseContract
{
    public function toResponse($request)
    {
        return Auth::check()
            ? redirect('/admin')
            : view('auth.register');
    }
}

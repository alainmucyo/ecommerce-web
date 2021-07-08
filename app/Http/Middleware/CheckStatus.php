<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{

    public function handle($request, Closure $next)
    {
        $response = $next($request);
        //If the status is not approved redirect to login
        if (Auth::check() && !Auth::user()->status) {
            Auth::logout();
            return redirect()->back()->with('info', 'Sorry your account is not active. Please contact us for more details!');
        }
        return $response;
    }
}

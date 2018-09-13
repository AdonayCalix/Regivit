<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCandidateUser
{

    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->user_type < 3) {
            return response(view('errors.error_403'));
        }
        return $next($request);
    }
}

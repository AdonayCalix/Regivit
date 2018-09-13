<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Closure;

class CheckMasterUser
{

    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->user_type != 1) {
            return response(view('errors.error_403'));
        }
        return $next($request);
    }
}

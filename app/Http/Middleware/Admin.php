<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type == 2) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }

    }
}

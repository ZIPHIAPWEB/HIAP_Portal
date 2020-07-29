<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch(Auth::guard($guard)->user()->role) {
                case 'client':
                    return redirect()->route('cl.dashboard');
                break;

                case 'teacher':
                    return redirect()->route('tc.dashboard');
                break;

                case 'superadministrator':
                    return redirect()->route('sa.dashboard');
                break;

                case 'moderator':
                    return redirect()->route('md.dashboard');
                break;
            }
        }

        return $next($request);
    }
}

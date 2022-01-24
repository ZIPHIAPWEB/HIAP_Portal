<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ConstantRoleHelper as Role;
use Symfony\Component\HttpFoundation\Response;

class CheckIfModeratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $isNotModerator = Auth::user()->role !== Role::MODERATOR;
        
        if($isNotModerator) {
            
            $isAjax = $request->ajax();
            
            if ($isAjax) {
                return response()->json('You are not a ' . Role::MODERATOR, Response::HTTP_UNAUTHORIZED);
            }

            return redirect('/login')
                ->withErrors('Not a ' . Role::MODERATOR);
        }

        return $next($request);
    }
}

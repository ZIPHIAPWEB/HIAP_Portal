<?php

namespace App\Http\Middleware;

use App\Helpers\ConstantRoleHelper as Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfSuperadminMiddleware
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
        $isNotSuperadmin = Auth::user()->role !== Role::SUPERADMINISTRATOR;
        
        if($isNotSuperadmin) {
            
            $isAjax = $request->ajax();
            
            if ($isAjax) {
                return response()->json('You are not a ' . Role::SUPERADMINISTRATOR, Response::HTTP_UNAUTHORIZED);
            }

            return redirect('/login')
                ->withErrors('Not a ' . Role::SUPERADMINISTRATOR);
        }

        return $next($request);
    }
}

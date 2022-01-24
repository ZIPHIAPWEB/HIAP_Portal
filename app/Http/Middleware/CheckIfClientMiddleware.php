<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\ConstantRoleHelper as Role;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfClientMiddleware
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
        $isNotClient = Auth::user()->role !== Role::CLIENT;
        
        if($isNotClient) {
            
            $isAjax = $request->ajax();
            
            if ($isAjax) {
                return response()->json('You are not a ' . Role::CLIENT, Response::HTTP_UNAUTHORIZED);
            }

            return redirect('/login')
                ->withErrors('Not a ' . Role::CLIENT);
        }

        return $next($request);
    }
}

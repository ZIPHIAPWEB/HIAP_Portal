<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\ConstantRoleHelper as Role;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfAccountingMiddleware
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
        $isNotAccounting = Auth::user()->role !== Role::ACCOUNTING;
        
        if($isNotAccounting) {
            
            $isAjax = $request->ajax();
            
            if ($isAjax) {
                return response()->json('You are not a ' . Role::ACCOUNTING, Response::HTTP_UNAUTHORIZED);
            }

            return redirect('/login')
                ->withErrors('Not a ' . Role::ACCOUNTING);
        }

        return $next($request);
    }
}

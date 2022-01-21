<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::user() && (Auth::user()->is_admin == 1)){
            return $next($request);
        }
        return 'you are not an admin';

    }
}

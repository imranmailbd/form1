<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next)
    {
        if(!Auth::user())
        {
        return redirect('login');
        }

        if(auth()->user()->role_id == 1){
            return $next($request);
        } else if(auth()->user()->role_id == 0){
            return $next($request);
        }

        return redirect('home')->with('error', "You have no proper authentication to access the area!");

    }


}

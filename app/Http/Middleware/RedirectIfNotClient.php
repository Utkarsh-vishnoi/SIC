<?php

namespace SIC\Http\Middleware;

use Auth;
use Closure;

class RedirectIfNotClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'client')
    {
        if (Auth::guard($guard)->guest()) {
            return redirect()->guest('client/login');
        }

        return $next($request);
    }
}

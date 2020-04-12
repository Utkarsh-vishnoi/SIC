<?php

namespace SIC\Http\Middleware;

use Auth;
use Closure;

class RedirectIfNotStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'student')
    {
        if (Auth::guard($guard)->guest()) {
            return redirect()->guest('student/login');
        }

        return $next($request);
    }
}

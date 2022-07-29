<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check() || !auth()->user()->is_admin) {
            abort(403);
        }
        return $next($request);
    }
}

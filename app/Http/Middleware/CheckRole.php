<?php

namespace App\Http\Middleware;

class CheckRole
{
    // /**
    //  * Handle an incoming request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
    //  * @param   string  $role
    //  * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    //  */
    // public function handle(Request $request, Closure $next, $role)
    // {
    //     if (! $request->user()->hasRole($role)){
    //         return view('dashboard');
    //     }
    //     return $next($request);
    // }
}

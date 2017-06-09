<?php

namespace App\Http\Middleware;

use Closure;

class SoftMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        session(['credential'=>'soft', 'name'=>'软件产品']);
        return $next($request);
    }
}

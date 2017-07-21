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
        session([
            'credential'=>config('transforms.soft'),
            'name'=>config('titles.soft')
        ]);
        return $next($request);
    }
}

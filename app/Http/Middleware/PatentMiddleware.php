<?php

namespace App\Http\Middleware;

use Closure;

class PatentMiddleware
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
            'credential'=>config('transforms.patent'),
            'name'=>config('titles.patent')
        ]);
        return $next($request);
    }
}

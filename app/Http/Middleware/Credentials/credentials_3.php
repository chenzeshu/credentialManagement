<?php

namespace App\Http\Middleware\Credentials;

use Closure;

class credentials_3
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
        session(['credential'=>config('transforms.credentials_3'),
            'name'=>config('titles.credential_3')]);
        return $next($request);
    }
}

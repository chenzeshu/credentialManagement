<?php

namespace App\Http\Middleware\Credentials;

use Closure;

class credentials_6
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
        session(['credential'=>config('transforms.credentials_6'),
            'name' => config('titles.credential_6')]);
        return $next($request);
    }
}

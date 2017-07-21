<?php

namespace App\Http\Middleware\Credentials;

use Closure;

class credentials_basic
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
        session(['credential'=>config('transforms.credentials_basic'),
            'name' => config('titles.credential_basic')
        ]);
        return $next($request);
    }
}

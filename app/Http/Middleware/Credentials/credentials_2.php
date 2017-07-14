<?php

namespace App\Http\Middleware\Credentials;

use Closure;

class credentials_2
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
        session(['credential'=>'credentials_2',
            'name' => config('titles.credential_2')
        ]);
        return $next($request);
    }
}

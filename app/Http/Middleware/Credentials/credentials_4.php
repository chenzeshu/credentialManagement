<?php

namespace App\Http\Middleware\Credentials;

use Closure;

class credentials_4
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
        session(['credential'=>'credentials_4',
            'name' => '商标']);
        return $next($request);
    }
}

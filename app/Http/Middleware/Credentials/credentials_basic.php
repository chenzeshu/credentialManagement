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
        session(['credential'=>'credentials_basic',
            'name' => '基本资质']);
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware\Credentials;

use Closure;

class credentials_5
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
        session(['credential'=>'credentials_5',
            'name' => '体系贯标数据']);
        return $next($request);
    }
}

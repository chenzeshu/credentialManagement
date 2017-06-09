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
        session(['credential'=>'credentials_3',
            'name'=>'服务感谢信']);
        return $next($request);
    }
}

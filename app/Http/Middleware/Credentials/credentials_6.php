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
        session(['credential'=>'credentials_6',
            'name' => '第三方产品监测、鉴定']);
        return $next($request);
    }
}

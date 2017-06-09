<?php

namespace App\Http\Middleware\Credentials;

use Closure;

class credentials_1
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
        session(['credential'=>'credentials_1',
            'name' => '服务基地、研发中心',
            'url_name'=>'']);
        return $next($request);
    }
}

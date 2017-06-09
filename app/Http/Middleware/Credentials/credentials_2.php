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
            'name' => '获奖、荣誉表、高新技术产品']);
        return $next($request);
    }
}

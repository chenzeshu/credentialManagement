<?php

namespace App\Http\Middleware;

use App\Histroy;
use Closure;
use Illuminate\Support\Facades\Auth;

class ShowCount
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
        if(Auth::user()->hasRole('checker')){
            $count = Histroy::where('checker_id',Auth::id())->where('examine_type', 0)->count();
            session(['count'=>$count]);
        }
        return $next($request);
    }
}

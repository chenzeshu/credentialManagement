<?php

namespace App\Http\Controllers;

use App\Histroy;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 简化各个控制器的权限中间件的设置
     * @param $perm
     * @param array $api
     */
    public function setPerms($perm, Array $api)
    {
        $this->middleware('permission:'. $perm)->only($api);
    }
}

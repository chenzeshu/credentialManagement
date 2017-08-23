<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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

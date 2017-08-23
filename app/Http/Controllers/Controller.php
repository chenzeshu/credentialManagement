<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;

    function __construct()
    {

    }

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

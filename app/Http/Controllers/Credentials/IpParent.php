<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/4
 * Time: 17:05
 */

namespace App\Http\Controllers\Credentials;


use App\Http\Controllers\Controller;

class IpParent extends Controller
{
    function __construct()
    {
        $this->setPerms(config('perms.ip.insert'), ['store']);
        $this->setPerms(config('perms.ip.edit'), ['update']);
        $this->setPerms(config('perms.ip.del'), ['destroy','deleteFile']);
        $this->setPerms(config('perms.ip.download'), ['download']);
    }
}
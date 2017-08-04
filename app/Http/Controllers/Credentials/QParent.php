<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/4
 * Time: 17:05
 */

namespace App\Http\Controllers\Credentials;


use App\Http\Controllers\Controller;

class QParent extends Controller
{
    function __construct()
    {
        $this->setPerms(config('perms.q.insert'), ['store']);
        $this->setPerms(config('perms.q.edit'), ['update']);
        $this->setPerms(config('perms.q.del'), ['destroy','deleteFile']);
        $this->setPerms(config('perms.q.download'), ['download']);
    }
}
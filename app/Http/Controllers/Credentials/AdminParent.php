<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/4
 * Time: 17:18
 */

namespace App\Http\Controllers\Credentials;

use App\Http\Controllers\Controller;

class AdminParent extends Controller
{
    function __construct()
    {
        $this->setPerms(config('perms.admin.insert'), ['store']);
        $this->setPerms(config('perms.admin.edit'), ['update']);
        $this->setPerms(config('perms.admin.del'), ['destroy']);
    }
}
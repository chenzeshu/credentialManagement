<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/4
 * Time: 17:05
 */

namespace App\Http\Controllers\Credentials;

use App\Http\Controllers\Controller;

class CredentialParent extends Controller
{
    function __construct()
    {
        $this->setPerms(config('perms.credential.insert'), ['store']);
        $this->setPerms(config('perms.credential.edit'), ['update']);
        $this->setPerms(config('perms.credential.del'), ['destroy','deleteFile']);
        $this->setPerms(config('perms.credential.download'), ['download']);
    }
}
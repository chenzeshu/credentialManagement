<?php


function checkPerm($perm){
    $bool = \Illuminate\Support\Facades\Auth::user()->can($perm);
    return $bool;
}

//得到当前登陆者信息的缓存
function getMe(){
    return \Illuminate\Support\Facades\Cache::get('user'.\Illuminate\Support\Facades\Auth::id());
}
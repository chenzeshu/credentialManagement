<?php


function checkPerm($perm){
    $bool = \Illuminate\Support\Facades\Auth::user()->can($perm);
    return $bool;
}
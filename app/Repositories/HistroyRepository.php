<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/5
 * Time: 9:30
 */

namespace App\Repositories;


class HistroyRepository
{
    public function checkType($histroy)
    {
        $type = $histroy->examine_type;
        if($type!==1) {
            dd("请通过正常方式进入页面");
        }
    }

    public function checkDate($histroy)
    {
        $check = strtotime($histroy->end_at);

        if($check == false || $check < time()){
            return false;
        }else{
            return  true;
        }
    }

}
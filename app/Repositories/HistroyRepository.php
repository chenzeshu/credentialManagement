<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/5
 * Time: 9:30
 */

namespace App\Repositories;


use App\User;

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

    /**
     * 拿到审批人
     */
    public function getChecker($reason_type)
    {
        if($reason_type==0){
            $checker= User::where('name','钱正宇')->first();
        }else{
            $checker= User::where('name','高晓峰')->first();
        }
        return $checker;
    }

}
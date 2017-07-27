<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/24
 * Time: 16:17
 */

namespace App\Events;
use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;

class CheckerChangement
{
    use SerializesModels;

    public $manage_util;    //修改内容
    public $time;           //修改时间
    public $checker_name;   //修改者
    public $user_id;        //被通知人id
    public $histroy_id;

    public function __construct(Array $manage_util, $checker_name, $user_id, $histroy_id)
    {
        $this->manage_util = $manage_util;
        $this->time = Carbon::now();
        $this->checker_name = $checker_name;
        $this->user_id = $user_id;
        $this->histroy_id = $histroy_id;
    }

}
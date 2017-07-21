<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/5
 * Time: 9:30
 */

namespace App\Repositories;


use App\Jobs\UpdateHistroyJob;
use App\User;
use Illuminate\Support\Facades\Auth;

class HistroyRepository
{
    public function check($histroy)
    {
        $this->checkType($histroy);
        return $this->checkDate($histroy);
    }
    
    private function checkType($histroy)
    {
        $type = $histroy->examine_type;
        if($type!==1) {
            dd("请通过正常方式进入页面");
        }
    }

    private function checkDate($histroy)
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

    /**
     * 拿到历史细节表的对应内容并反序列化
     * @param $histroy
     * @return mixed
     */
    public function transformDetail($histroy){
        $details = $histroy->histroy_details()->paginate(15);
        foreach ($details as $detail){
            $detail->file_path = unserialize($detail->file_path);
        }
        return $details;
    }

    /**
     * 用户提交临时表至审批队列
     * @param $request
     */
    public function dispatchUpdateToQueue($request)
    {
        //todo 逻辑开始
        $checker = $this->getChecker($request->reason_type); //拿到审批人
        //todo 触发事件进入队列
        $job = (new UpdateHistroyJob($checker, Auth::id(), $request->reason_type, $request->reason_project, $request->reason_words))->onQueue('foo');
        $this->dispatch($job);
    }

}
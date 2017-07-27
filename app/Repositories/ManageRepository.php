<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/13
 * Time: 11:00
 */

namespace App\Repositories;


use App\Events\CheckerChangement;
use App\Events\CheckerDelment;
use App\Histroy;
use App\User;
use Illuminate\Support\Facades\Auth;

class ManageRepository
{
    /**
     * 得到用户提交表单的基本信息
     * @param $histroy
     * @return mixed
     */
    public function getInfoForShow($histroy)
    {
        $username = $histroy->user()->first()->name;
        $info = $histroy->first();
        $info->reason_project = $info->reason_project ? $info->reason_project : '未填写项目名称';
        $info['username'] = $username;
        return $info;
    }

    /**
     * 得到用户提交表单的详细信息(文件内容)
     * 并对文件路径反序列化
     * @param $history
     */
    public function getDetailsForShow($histroy)
    {
        $details = $histroy->histroy_details()->orderBy('id', 'desc')->paginate(15);
        foreach ($details as $k=>$detail){
            $detail->file_path = unserialize($detail->file_path);
        }
        return $details;
    }

    /**
     * 审批员修改审批表时的消息机制
     * @param $adds
     * @param $histroy_id
     */
    public function insertChangeMsg($adds)
    {
        $msg = $this->getMsgInfo();
        event(new CheckerChangement($adds,$msg['checker_name'], $msg['user_id'], $msg['histroy_id']));
    }

    /**
     * 审批员删除审批表的细节时的消息机制
     * @param $detail
     */
    public function insertDelMsg($detail)
    {
        $delName = $detail->file_name;
        $msg = $this->getMsgInfo();
        event(new CheckerDelment($delName, $msg['checker_name'], $msg['user_id'], $msg['histroy_id']));
    }

    private function getMsgInfo(){
        $histroy = Histroy::findOrFail(session('histroy_id'));
        $name = $histroy->checker()->first()->name;
        $msg = [
            'user_id' => $histroy->user_id,
            'checker_name'=> $name,
            'histroy_id' => $histroy->id
        ];
        return $msg;
    }
}
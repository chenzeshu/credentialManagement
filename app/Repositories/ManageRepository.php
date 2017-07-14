<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/13
 * Time: 11:00
 */

namespace App\Repositories;


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
        $details = $histroy->histroy_details()->paginate(15);
        foreach ($details as $k=>$detail){
            $detail->file_path = unserialize($detail->file_path);
        }
        return $details;
    }
}
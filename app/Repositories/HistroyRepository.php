<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/5
 * Time: 9:30
 */

namespace App\Repositories;


use App\Histroy;
use App\Jobs\UpdateHistroyJob;
use App\SelfTable;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

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
            $checker= User::where('name','钱正宇')->where('email', '!=', 'test2@qq.com')->first();
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
//        $job = (new UpdateHistroyJob($checker, Auth::id(), $request->reason_type, $request->reason_project, $request->reason_words))->onQueue('foo');
//        dispatch($job);
        //todo 20180514放弃队列
        $this->updateHandle($checker, Auth::id(), $request->reason_type, $request->reason_project, $request->reason_words);
    }

    private function updateHandle(User $checker, $id, $reason_type, $reason_project, $reason_words)
    {
        $details = User::findOrFail($id)->selfTables()->get();

        DB::beginTransaction();
        try{
            //todo 在histroy表中生成记录
            $histroy = User::findOrFail($id)->histroies()->create([
                'checker_id'=> $checker->id,
                'reason_type'=> $reason_type,
                'reason_project'=> $reason_project,
                'reason_words'=> $reason_words,
                'examine_type'=> 0 //审批中
            ]);
            //todo 将临时表数据迁移到Histroy_details表中
            foreach ($details as $detail){
                Histroy::findOrFail($histroy->id)->histroy_details()->create([
                    'file_id'=>$detail->file_id,
                    'file_name'=>$detail->file_name,
                    'file_belongs' => $detail->file_belongs,
                    'file_path' => $detail->file_path
                ]);  //不能直接放二维数组
            }
            //todo 清空临时表
            SelfTable::where('user_id',$id)->delete();
        }catch (Exception $e){
            DB::rollback();
            throw $e;
        }finally{
            DB::commit();
        }
    }
}
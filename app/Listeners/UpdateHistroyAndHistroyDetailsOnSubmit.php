<?php

namespace App\Listeners;

use App\Events\Submit;
use App\Histroy;
use App\User;
use App\SelfTable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateHistroyAndHistroyDetailsOnSubmit implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Submit  $event
     * @return void
     */
    public function handle(Submit $event)
    {

        $checker = $event->checker;
        $details = User::findOrFail($event->id)->selfTables()->get();

           DB::beginTransaction();
           try{
                //todo 在histroy表中生成记录
                $histroy = User::findOrFail($event->id)->histroies()->create([
                    'checker_id'=>$checker->id,
                    'reason_type'=>$event->reason_type,
                    'reason_words'=>$event->reason_words,
                    'examine_type'=>0 //审批中
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
                SelfTable::where('user_id',$event->id)->delete();
           }catch (Exception $e){
               DB::rollback();
               throw $e;
           }finally{
               DB::commit();
           }

    }

    public function failded(Submit $event, $e)
    {
        dd('submit队列失败了！');

    }
}

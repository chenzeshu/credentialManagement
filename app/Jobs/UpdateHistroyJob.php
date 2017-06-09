<?php

namespace App\Jobs;

use App\Histroy;
use App\SelfTable;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

//class UpdateHistroyJob extends Job implements ShouldQueue
class UpdateHistroyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reason_type;
    protected $reason_words;
    protected $checker;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $checker, $id, $reason_type, $reason_words)
    {
        $this->reason_type = $reason_type;
        $this->reason_words = $reason_words;
        $this->checker = $checker;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $checker = $this->checker;
        $details = User::findOrFail($this->id)->selfTables()->get();

        DB::beginTransaction();
        try{
            //todo 在histroy表中生成记录
            $histroy = User::findOrFail($this->id)->histroies()->create([
                'checker_id'=>$checker->id,
                'reason_type'=>$this->reason_type,
                'reason_words'=>$this->reason_words,
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
            SelfTable::where('user_id',$this->id)->delete();
        }catch (Exception $e){
            DB::rollback();
            throw $e;
        }finally{
            DB::commit();
        }
    }
}

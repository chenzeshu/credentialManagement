<?php

namespace App\Listeners;

use App\Events\CheckerChangement;
use App\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeMessage
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
     * @param  CheckerChangement  $event
     * @return void
     */
    public function handle(CheckerChangement $event)
    {
        //todo 得到filenames数组
        $names = $this->initName($event->manage_util);

        Message::firstOrCreate([
            'checker_name'=> $event->checker_name,
            'histroy_id'=>$event->histroy_id,
            'names' => $names,
            'time' => $event->time,
            'user_id' => $event->user_id,
            'type' => 0 //修改为0
        ]);

        //fixme $re的throw E一期就不写了，赶着做下个项目
        //...
    }

    private function initName($contents){
        //初始化name
        $names = [];
        foreach ($contents as $content){
            $names[] = $content['file_name'];
        }
        $names = serialize($names);
        return $names;
    }

}

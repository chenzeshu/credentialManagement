<?php

namespace App\Listeners;

use App\Events\CheckerDelment;
use App\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DelMessage
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
     * @param  CheckerDelment  $event
     * @return void
     */
    public function handle(CheckerDelment $event)
    {
        //todo 得到filenames数组
        Message::firstOrCreate([
            'checker_name'=> $event->checker_name,
            'histroy_id' => $event->histroy_id,
            'names' => $event->delName,
            'time' => $event->time,
            'user_id' => $event->user_id,
            'type' => 1 //删除为1
        ]);

        //fixme $re的throw E一期就不写了，赶着做下个项目
        //...
    }
}

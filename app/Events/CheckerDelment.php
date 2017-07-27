<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckerDelment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $delName;        //修改内容string
    public $time;           //修改时间
    public $checker_name;   //修改者
    public $user_id;        //被通知人id
    public $histroy_id;     //审批表id
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($delName, $checker_name, $user_id, $histroy_id)
    {
        $this->delName = $delName;
        $this->time = Carbon::now();
        $this->checker_name = $checker_name;
        $this->user_id = $user_id;
        $this->histroy_id = $histroy_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

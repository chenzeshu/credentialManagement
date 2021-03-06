<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Submit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reason_type;
    public $reason_words;
    public $checker;
    public $id;

    /**
     * Create a new event instance.
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
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

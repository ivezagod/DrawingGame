<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DrawingUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    public $coordinates;
    public $url;


    public function __construct($coordinates , $url)
    {
     $this->coordinates = $coordinates;
     $this->url = $url;
    }

    public function broadcastOn()
    {
        Log::info('drawing-channel.'.$this->url);

        return new Channel('drawing-channel.'.$this->url);
    }
}



<?php

namespace App\Events;
use App\User;
use App\Modulo;
use App\Turno;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TurneroManualTurno implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $turno;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Turno $turno)
    {
       $this->user = $user;
       $this->turno = $turno;
   }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('turnero-turno');
    }
}

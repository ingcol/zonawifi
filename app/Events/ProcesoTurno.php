<?php

namespace App\Events;
use App\User;
use App\Modulo;
use App\Turno;
use App\Departamento;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProcesoTurno implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
public $user;
public $turno;
public $modulo;
public $departamento;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Turno $turno,Modulo $modulo,Departamento $departamento)
    {
        $this->user = $user;
        $this->turno = $turno;
        $this->modulo = $modulo;
        $this->departamento = $departamento;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('proceso-turno');
    }
}

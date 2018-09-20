<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ContainerCommandResponseEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $container;

    public $command_response;

    public $broadcastQueue = 'high';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($container, $command_response)
    {
        $this->container = $container;
        $this->command_response = $command_response;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('container.' . $this->container);
    }

    public function broadcastAs()
    {
        return 'container.command.response';
    }
}

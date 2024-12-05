<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewFollowerEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $follower;
    public $user;

    public function __construct(User $follower, User $user)
    {
        $this->follower = $follower;
        $this->user = $user;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('notifications.' . $this->user->id)
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->follower->id,
            'username' => $this->follower->username,
            'message' => "{$this->follower->username} started following you!",
        ];
    }
}

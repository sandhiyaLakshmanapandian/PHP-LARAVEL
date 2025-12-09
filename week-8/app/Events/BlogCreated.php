<?php

namespace App\Events;

use App\Models\Blog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BlogCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

   /**
     * The blog instance that has been created.
     *
     * This event is fired right after a blog is successfully created.
     *
     * @var \App\Models\Blog
     */
    public $blog;

    
    /**
     * Create a new event instance.
     */

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;// Assign the created blog instance to the event
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}

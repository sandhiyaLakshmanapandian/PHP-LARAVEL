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

class BlogUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The blog instance that has been created.
     *
     * This event is fired right after a blog is successfully Updated.
     *
     * @var \App\Models\Blog
     */
     public $blog;

    public function __construct(Blog $blog)
    {
        //
        $this->blog = $blog;// Assign the created blog instance to the event
        \Log::info('🔥 BlogUpdated event fired for blog ID: '.$blog->id);
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

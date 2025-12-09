<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\BlogCreated;
use App\Mail\BlogCreatedMarkdownMail;
use Illuminate\Support\Facades\Mail;

class SendBlogCreatedMarkdownMail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BlogCreated $event): void
    {
        //
        Mail::to(config('mail.admin_address'))
            ->queue(new BlogCreatedMarkdownMail($event->blog));//sending mail to the admin .configurations done in config/mail.php and env file.
    }
}

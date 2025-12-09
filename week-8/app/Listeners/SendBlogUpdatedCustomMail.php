<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\BlogUpdated;
use App\Mail\BlogUpdatedCustomMail;
use Illuminate\Support\Facades\Mail;

class SendBlogUpdatedCustomMail implements ShouldQueue
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
    public function handle(BlogUpdated $event): void
    {
        //
        Mail::to(config('mail.admin_address'))
            ->queue(new BlogUpdatedCustomMail($event->blog));
            
            //sending mail to the admin .configurations done in config/mail.php and env file.
    
    }
}

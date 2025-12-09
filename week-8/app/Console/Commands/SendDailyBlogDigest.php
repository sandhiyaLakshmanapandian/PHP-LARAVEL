<?php

namespace App\Console\Commands;
use App\Mail\DailyBlogDigestMail;
use App\Models\Blog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class SendDailyBlogDigest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'blogs:daily-digest'; //comment to run
    protected $description = 'Send daily email of blogs created yesterday';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
         $yesterday = now()->subDay()->toDateString();

        $blogs = Blog::whereDate('created_at', $yesterday)->get();//getting blogs of yesterdays

        if ($blogs->count()) {
            Mail::to(config('mail.admin_address'))
                ->queue(new DailyBlogDigestMail($blogs));//
        }

        $this->info('Daily blog digest sent successfully');
    
    }
}

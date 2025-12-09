<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    protected $listen = [
    \App\Events\BlogCreated::class => [
        \App\Listeners\SendBlogCreatedMarkdownMail::class,
    ],

    \App\Events\BlogUpdated::class => [
        \App\Listeners\SendBlogUpdatedCustomMail::class,
    ],
];
    public function register(): void
    {
        //
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

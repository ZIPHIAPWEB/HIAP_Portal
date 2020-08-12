<?php

namespace App\Listeners;

use App\Events\UserLogCreated;
use App\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserLogCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLogCreated  $event
     * @return void
     */
    public function handle(UserLogCreated $event)
    {
        Log::create($event->values);
    }
}

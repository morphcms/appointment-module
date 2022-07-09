<?php

namespace Modules\Appointment\Listeners;

use Modules\Appointment\Events\MeetingCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersIfMeetingCreated
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
     * @param MeetingCreated $event
     * @return void
     */
    public function handle(MeetingCreated $event)
    {
        //
    }
}

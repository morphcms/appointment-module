<?php

namespace Modules\Appointment\Listeners;

use Modules\Appointment\Events\MeetingRescheduled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersIfMeetingRescheduled
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
     * @param MeetingRescheduled $event
     * @return void
     */
    public function handle(MeetingRescheduled $event)
    {
        //
    }
}

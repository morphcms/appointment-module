<?php

namespace Modules\Appointment\Listeners;

use Laravel\Nova\Notifications\NovaNotification;
use Modules\Appointment\Events\MeetingUpdated;

class NotifyUsersOfAMeetingUpdate
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
     * @param MeetingUpdated $event
     * @return void
     */
    public function handle(MeetingUpdated $event)
    {

    }
}

<?php

namespace Modules\Appointment\Listeners;

use Laravel\Nova\Notifications\NovaNotification;
use Modules\Appointment\Events\MeetingApproved;
use Modules\Appointment\Events\MeetingRescheduled;

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
    public function handle(MeetingRescheduled $event): void
    {
        $event->user->notify(
            NovaNotification::make()
                ->message('Your meeting is rescheduled.')
                ->type('info')
        );
    }

}

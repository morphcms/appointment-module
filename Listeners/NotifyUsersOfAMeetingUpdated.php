<?php

namespace Modules\Appointment\Listeners;

use Laravel\Nova\Notifications\NovaNotification;
use Modules\Appointment\Events\MeetingUpdated;

class NotifyUsersOfAMeetingUpdated
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
     * @param  MeetingUpdated  $event
     * @return void
     */
    public function handle(MeetingUpdated $event): void
    {
        $event->user->notify(
            NovaNotification::make()
                ->message('Your meeting is rescheduled.')
                ->type('info')
        );
    }
}

<?php

namespace Modules\Appointment\Listeners;

use Laravel\Nova\Notifications\NovaNotification;
use Modules\Appointment\Events\MeetingRejected;

class NotifyUsersIfMeetingRejected
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
     * @param  MeetingRejected  $event
     * @return void
     */
    public function handle(MeetingRejected $event): void
    {
        $event->user->notify(
            NovaNotification::make()
                ->message('Your meeting is rejected.')
                ->type('info')
        );
    }
}

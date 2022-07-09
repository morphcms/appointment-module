<?php

namespace Modules\Appointment\Listeners;

use Laravel\Nova\Notifications\NovaNotification;
use Modules\Appointment\Events\MeetingApproved;

class NotifyUsersIfMeetingApproved
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param MeetingApproved $event
     * @return void
     */
    public function handle(MeetingApproved $event): void
    {
        $event->request->user()->notify(
            NovaNotification::make()
                ->message('Your meeting is approved.')
                ->type('info')
        );
    }

}

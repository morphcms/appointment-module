<?php

namespace Modules\Appointment\Listeners;

use Laravel\Nova\Notifications\NovaNotification;
use Modules\Appointment\Events\MeetingCreated;

class NotifyUsersOfAMeetingCreated
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
     * @param  MeetingCreated  $event
     * @return void
     */
    public function handle(MeetingCreated $event): void
    {
        $event->user->notify(
            NovaNotification::make()
                ->message('Your meeting was created.')
                ->type('info')
        );
    }
}

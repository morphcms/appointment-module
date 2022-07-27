<?php

namespace Modules\Appointment\Listeners;

use Laravel\Nova\Notifications\NovaNotification;
use Modules\Appointment\Events\MeetingApproved;
use Modules\Appointment\Events\MeetingCompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersIfMeetingCompleted
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
     * @param MeetingCompleted $event
     * @return void
     */
    public function handle(MeetingCompleted $event): void
    {
        $event->user->notify(
            NovaNotification::make()
                ->message('Your meeting is completed.')
                ->type('info')
        );
    }

}

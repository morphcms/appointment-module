<?php

namespace Modules\Appointment\Listeners;

use Laravel\Nova\Notifications\NovaNotification;
use Modules\Appointment\Events\MeetingApproved;
use Modules\Appointment\Events\MeetingRejected;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param MeetingRejected $event
     * @return void
     */
    public function handle(MeetingRejected $event): void
    {
        $event->request->user()->notify(
            NovaNotification::make()
                ->message('Your meeting is rejected.')
                ->type('info')
        );
    }

}

<?php

namespace Modules\Appointment\Listeners;

use Laravel\Nova\Notifications\NovaNotification;
use Modules\Appointment\Events\MeetingApproved;
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
    public function handle(MeetingCreated $event): void
    {
        $event->request->user()->notify(
            NovaNotification::make()
                ->message('Your meeting is created.')
                ->type('info')
        );
    }

}

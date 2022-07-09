<?php

namespace Modules\Appointment\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Appointment\Events\MeetingApproved;
use Modules\Appointment\Events\MeetingCompleted;
use Modules\Appointment\Events\MeetingCreated;
use Modules\Appointment\Events\MeetingRejected;
use Modules\Appointment\Events\MeetingUpdated;
use Modules\Appointment\Listeners\NotifyUsersIfMeetingApproved;
use Modules\Appointment\Listeners\NotifyUsersIfMeetingCompleted;
use Modules\Appointment\Listeners\NotifyUsersIfMeetingRejected;
use Modules\Appointment\Listeners\NotifyUsersIfMeetingRescheduled;
use Modules\Appointment\Listeners\NotifyUsersOfAMeetingCreate;
use Modules\Appointment\Listeners\NotifyUsersOfAMeetingUpdate;
use Nwidart\Modules\Facades\Module;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        MeetingCreated::class => [
            NotifyUsersOfAMeetingCreate::class,
        ],
        MeetingUpdated::class => [
            NotifyUsersOfAMeetingUpdate::class,
        ],
        MeetingApproved::class => [
            NotifyUsersIfMeetingApproved::class,
        ],
        MeetingCompleted::class => [
            NotifyUsersIfMeetingCompleted::class,
        ],
        MeetingRejected::class => [
            NotifyUsersIfMeetingRejected::class,
        ],
        NotifyUsersIfMeetingRescheduled::class => [
            NotifyUsersIfMeetingRescheduled::class,
        ],
    ];

    // TODO: Register all events and listeners automatically
//    /**
//     * Determine if events and listeners should be automatically discovered.
//     *
//     * @return bool
//     */
//    public function shouldDiscoverEvents()
//    {
//        return true;
//    }
//
//    /**
//     * Get the listener directories that should be used to discover events.
//     *
//     * @return array
//     */
//    protected function discoverEventsWithin()
//    {
//        return [
//            Module::getModulePath('appointment') . 'Listeners',
//        ];
//    }

}

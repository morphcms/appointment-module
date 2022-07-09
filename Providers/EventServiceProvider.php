<?php

namespace Modules\Appointment\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Appointment\Events\MeetingApproved;
use Modules\Appointment\Listeners\NotifyUsersIfMeetingApproved;
use Nwidart\Modules\Facades\Module;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        MeetingApproved::class => [
            NotifyUsersIfMeetingApproved::class,
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

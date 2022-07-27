<?php

namespace Modules\Appointment\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Appointment\Events\MeetingApproved;
use Modules\Appointment\Events\MeetingCompleted;
use Modules\Appointment\Events\MeetingCreated;
use Modules\Appointment\Events\MeetingRejected;
use Modules\Appointment\Events\MeetingRescheduled;
use Modules\Appointment\Events\MeetingUpdated;
use Modules\Appointment\Listeners\CreateGroupChatWhenAMeetingWasApproved;
use Modules\Appointment\Listeners\DeleteGroupIfMeetingStatusIsCompleted;
use Modules\Appointment\Listeners\NotifyUsersIfMeetingApproved;
use Modules\Appointment\Listeners\NotifyUsersIfMeetingCompleted;
use Modules\Appointment\Listeners\NotifyUsersIfMeetingRejected;
use Modules\Appointment\Listeners\NotifyUsersIfMeetingRescheduled;
use Modules\Appointment\Listeners\NotifyUsersOfAMeetingCreated;
use Modules\Appointment\Listeners\NotifyUsersOfAMeetingUpdated;
use Modules\Appointment\Listeners\UpdateMeetingStatusWhenChatIsClosed;
use RTippin\Messenger\Events\ThreadArchivedEvent;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        MeetingCreated::class => [
            NotifyUsersOfAMeetingCreated::class,
        ],
        MeetingUpdated::class => [
            NotifyUsersOfAMeetingUpdated::class,
        ],
        MeetingApproved::class => [
            NotifyUsersIfMeetingApproved::class,
            CreateGroupChatWhenAMeetingWasApproved::class,
        ],
        MeetingCompleted::class => [
            NotifyUsersIfMeetingCompleted::class,
            DeleteGroupIfMeetingStatusIsCompleted::class,
        ],
        MeetingRejected::class => [
            NotifyUsersIfMeetingRejected::class,
        ],
        MeetingRescheduled::class => [
            NotifyUsersIfMeetingRescheduled::class,
        ],
        ThreadArchivedEvent::class => [
            UpdateMeetingStatusWhenChatIsClosed::class,
        ]
    ];

}

<?php

namespace Modules\Appointment\Listeners;

use Modules\Appointment\Enum\MeetingStatus;
use Modules\Appointment\Models\Meeting;
use RTippin\Messenger\Events\ThreadArchivedEvent;

class UpdateMeetingStatusWhenChatIsClosed
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
     * @param ThreadArchivedEvent $event
     * @return void
     */
    public function handle(ThreadArchivedEvent $event): void
    {
        Meeting::query()
            ->where('chat_id', $event->thread->id)
            ->update([
                'status' => MeetingStatus::Completed->value,
                'chat_id' => null,
            ]);
    }

}

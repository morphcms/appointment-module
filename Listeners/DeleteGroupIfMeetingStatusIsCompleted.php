<?php

namespace Modules\Appointment\Listeners;

use Exception;
use Modules\Appointment\Events\MeetingCompleted;
use RTippin\Messenger\Actions\Threads\ArchiveThread;
use RTippin\Messenger\Models\Thread;

class DeleteGroupIfMeetingStatusIsCompleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(public ArchiveThread $archiveThread)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MeetingCompleted  $event
     * @return void
     *
     * @throws Exception
     */
    public function handle(MeetingCompleted $event): void
    {
        $thread = Thread::findOrNew($event->meeting->chat_id);

        if ($thread->exists()) {
            $this->archiveThread
                ->withoutEvents()
                ->execute($thread);
        }

        $event->meeting->update([
            'chat_id' => null,
        ]);
    }
}

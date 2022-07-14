<?php

namespace Modules\Appointment\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Appointment\Models\Meeting;

class MeetingCanceled
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public Meeting $meeting)
    {
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}

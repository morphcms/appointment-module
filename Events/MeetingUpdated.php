<?php

namespace Modules\Appointment\Events;

use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Laravel\Nova\Notifications\NovaChannel;
use Modules\Appointment\Models\Meeting;

class MeetingUpdated
{
    use SerializesModels;

    public Meeting $meeting;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public Request $request)
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
        return [
            NovaChannel::class,
        ];
    }
}

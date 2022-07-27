<?php

namespace Modules\Appointment\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Laravel\Nova\Notifications\NovaChannel;

class MeetingRescheduled
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public User $user)
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

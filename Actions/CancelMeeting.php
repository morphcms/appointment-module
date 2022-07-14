<?php

namespace Modules\Appointment\Actions;

use App\Models\User;
use Modules\Appointment\Enum\MeetingStatus;
use Modules\Appointment\Events\MeetingCanceled;
use Modules\Appointment\Models\Meeting;

class CancelMeeting
{
    public function execute(Meeting $meeting): void
    {
        $meeting->update([
            'status' => MeetingStatus::Canceled->value,
        ]);

        event(new MeetingCanceled($meeting));
    }
}

<?php

namespace Modules\Appointment\Actions;

use Illuminate\Http\Request;
use Modules\Appointment\Events\MeetingRescheduled;
use Modules\Appointment\Models\Meeting;

class RescheduleMeeting
{
    public function execute(Request $request, Meeting $meeting): void
    {
        $validated = $request->validate([
            'starts_at' => ['required', 'after:yesterday', 'before_or_equal:ends_at', 'date'],
            'ends_at' => ['nullable', 'after_or_equal:starts_at', 'date'],
        ]);

        $meeting->update($validated);

        event(new MeetingRescheduled($request));
    }
}

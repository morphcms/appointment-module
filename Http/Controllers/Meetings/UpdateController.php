<?php

namespace Modules\Appointment\Http\Controllers\Meetings;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Appointment\Enum\MeetingStatus;
use Modules\Appointment\Models\Meeting;
use Modules\Appointment\Transformers\MeetingResource;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Meeting $meeting): MeetingResource
    {
        $validated = $request->validate([
            'starts_at' => ['required', 'after:yesterday', 'before_or_equal:ends_at', 'date'],
            'ends_at' => ['nullable', 'after_or_equal:starts_at', 'date'],
            'status' => ['nullable', Rule::in(MeetingStatus::values())],
            'notes' => ['nullable', 'string'],
            'title' => ['nullable', 'string'],
            'user_id' => ['exists:users,id'],
        ]);

        if (is_null($request->get('status'))) {
            $validated['status'] = MeetingStatus::Pending->value;
        }

        $meeting->update($validated);

        return new MeetingResource($meeting->load('user'));
    }
}

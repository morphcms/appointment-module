<?php

namespace Modules\Appointment\Http\Controllers\Meetings;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Appointment\Enum\MeetingStatus;
use Modules\Appointment\Models\Meeting;
use Modules\Appointment\Transformers\MeetingResource;

class StoreController extends Controller
{
    public function __invoke(Request $request): MeetingResource
    {
        $validated = $request->validate([
            'starts_at' => ['required', 'after:yesterday', 'date'],
            'number_of_minutes' => ['required', 'numeric', 'gte:30'],
            'status' => ['nullable', Rule::in(MeetingStatus::values())],
            'notes' => ['nullable', 'string'],
            'title' => ['nullable', 'string'],
            'user_id' => ['exists:users,id'],
        ]);

        if (is_null($request->get('status'))) {
            $validated['status'] = MeetingStatus::Pending->value;
        }

        $ends_at = new Carbon($validated['starts_at']);
        $ends_at->addMinutes($validated['number_of_minutes'])->toDateTimeString();

        $data = collect($validated)->except(['number_of_minutes'])->put('ends_at', $ends_at)->toArray();

        $meeting = Meeting::create($data);

        return new MeetingResource($meeting->load('user'));
    }
}

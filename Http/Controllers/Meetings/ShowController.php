<?php

namespace Modules\Appointment\Http\Controllers\Meetings;

use Illuminate\Routing\Controller;
use Modules\Appointment\Models\Meeting;
use Modules\Appointment\Transformers\MeetingResource;

class ShowController extends Controller
{
    public function __invoke(Meeting $meeting): MeetingResource
    {
        return new MeetingResource($meeting->load('user'));
    }
}

<?php

namespace Modules\Appointment\Http\Controllers\Meetings;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Modules\Appointment\Models\Meeting;
use Modules\Appointment\Transformers\MeetingResource;

class IndexController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $meetings = Meeting::query()->with('user')->get();

        return MeetingResource::collection($meetings);
    }
}

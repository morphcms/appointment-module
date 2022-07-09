<?php

namespace Modules\Appointment\Observers;

use Illuminate\Http\Request;
use Modules\Appointment\Enum\MeetingStatus;
use Modules\Appointment\Events\MeetingApproved;
use Modules\Appointment\Events\MeetingCompleted;
use Modules\Appointment\Events\MeetingRejected;
use Modules\Appointment\Events\MeetingRescheduled;
use Modules\Appointment\Models\Meeting;

class MeetingObserver
{

    public function __construct(public Request $request)
    {

    }

    /**
     * Handle the Meeting "created" event.
     *
     * @param Meeting $meeting
     * @return void
     */
    public function created(Meeting $meeting)
    {
        //
    }

//    /**
//     * Handle the Meeting "updated" event.
//     *
//     * @param Meeting $meeting
//     * @return void
//     */
    public function updated(Meeting $meeting): void
    {
        if($meeting->isDirty('status')){
            switch ($meeting->status){
                case MeetingStatus::Approved->value:
                    event(new MeetingApproved($this->request));
                    break;
                case MeetingStatus::Rejected->value:
                    event(new MeetingRejected($this->request));
                    break;
                case MeetingStatus::Completed->value:
                    event(new MeetingCompleted($this->request));
                    break;
                case MeetingStatus::Rescheduled->value:
                    event(new MeetingRescheduled($this->request));
                    break;
                default:
                    break;
            }
        }
    }


//    /**
//     * Handle the Meeting "updating" event.
//     *
//     * @param Meeting $meeting
//     * @return void
//     */
//    public function updating(Meeting $meeting): void
//    {
//        if($meeting->isDirty('status')){
//            switch ($meeting->status){
//                case MeetingStatus::Approved->value:
//                    event(new MeetingApproved());
//                    break;
//                default:
//                    break;
//            }
//        }
//    }

    /**
     * Handle the Meeting "deleted" event.
     *
     * @param Meeting $meeting
     * @return void
     */
    public function deleted(Meeting $meeting)
    {
        //
    }

    /**
     * Handle the Meeting "restored" event.
     *
     * @param Meeting $meeting
     * @return void
     */
    public function restored(Meeting $meeting)
    {
        //
    }

    /**
     * Handle the Meeting "force deleted" event.
     *
     * @param Meeting $meeting
     * @return void
     */
    public function forceDeleted(Meeting $meeting)
    {
        //
    }
}

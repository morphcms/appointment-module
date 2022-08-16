<?php

namespace Modules\Appointment\Listeners;

use App\Models\User;
use Modules\Appointment\Events\MeetingApproved;
use RTippin\Messenger\Actions\Threads\StoreGroupThread;
use RTippin\Messenger\Actions\Threads\StoreManyParticipants;
use Throwable;

class CreateGroupChatWhenAMeetingWasApproved
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(public StoreGroupThread $storeGroupThread, public StoreManyParticipants $storeManyParticipants)
    {
    }

    /**
     * Handle the event.
     *
     * @param  MeetingApproved  $event
     * @return void
     *
     * @throws Throwable
     */
    public function handle(MeetingApproved $event): void
    {
//        $guests = $event->meeting->guests;
//
//        $guests = collect($guests)->map(function ($guest) {
//            return [
//                'alias' => 'user',
//                'id' => $guest->user->id,
//            ];
//        });
//
//        $this->storeGroupThread->execute([
//            'subject' => $event->meeting->title,
//            'providers' => [
//                ...$guests,
//            ]
//        ]);
    }
}

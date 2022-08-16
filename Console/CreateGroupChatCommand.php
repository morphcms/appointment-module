<?php

namespace Modules\Appointment\Console;

use Illuminate\Console\Command;
use Modules\Appointment\Enum\MeetingStatus;
use Modules\Appointment\Models\Meeting;
use RTippin\Messenger\Actions\Threads\ArchiveThread;
use RTippin\Messenger\Actions\Threads\StoreGroupThread;
use RTippin\Messenger\Messenger;
use Throwable;

class CreateGroupChatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'appointment:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(public StoreGroupThread $storeGroupThread, public ArchiveThread $archiveThread, public Messenger $messenger)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws Throwable
     */
    public function handle(): void
    {
        $meetings = Meeting::query()
            ->with(['user', 'guests'])
            ->status(MeetingStatus::Approved)
            ->where('starts_at', '>=', today())
            ->get();

        foreach ($meetings as $meeting) {
            $guests = $meeting->guests->map(function ($guest) {
                return [
                    'alias' => 'user',
                    'id' => $guest->user->id,
                ];
            });

            $this->messenger->setProvider($meeting->user);

            $thread = $this->storeGroupThread->execute([
                'subject' => $meeting->title,
                'providers' => [
                    ...$guests,
                ],
            ]);

            $meeting->update([
                'status' => MeetingStatus::Active->value,
                'chat_id' => $thread->getThread()->id,
            ]);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [];
    }
}

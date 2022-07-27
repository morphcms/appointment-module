<?php

namespace Modules\Appointment\Enum;

use Modules\Morphling\Enums\HasSelectOptions;
use Modules\Morphling\Enums\HasValues;

enum MeetingStatus: string
{
    use HasValues, HasSelectOptions;

    case Approved = 'approved';
    case Rejected = 'rejected';
    case Rescheduled = 'rescheduled';
    case Pending = 'pending';
    case Completed = 'completed';
    case Canceled = 'canceled';
    case Active = 'active';

    public static function getNovaBadgeColors(): array
    {
        return [
            MeetingStatus::Approved->value => 'warning',
            MeetingStatus::Rejected->value => 'danger',
            MeetingStatus::Rescheduled->value => 'warning',
            MeetingStatus::Pending->value => 'info',
            MeetingStatus::Completed->value => 'success',
            MeetingStatus::Canceled->value => 'danger',
            MeetingStatus::Active->value => 'success',
        ];
    }
}

<?php

namespace Modules\Appointment\Enum;

use Modules\Morphling\Enums\HasSelectOptions;
use Modules\Morphling\Enums\HasValues;

enum MeetingPermission: string
{
    use HasValues, HasSelectOptions;

    case All = 'meetings.*';
    case  ViewAny = 'meetings.viewAny';
    case  ViewOwned = 'meetings.viewOwned';
    case  View = 'meetings.view';
    case  Create = 'meetings.create';
    case  Update = 'meetings.update';
    case  Delete = 'meetings.delete';
    case  Replicate = 'meetings.replicate';
    case  Restore = 'meetings.restore';
}

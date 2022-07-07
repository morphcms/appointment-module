<?php

namespace Modules\Appointment\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Appointment\Models\Meeting;

trait HasMeeting
{
    public function meeting(): HasOne
    {
        return $this->hasOne(Meeting::class);
    }
}

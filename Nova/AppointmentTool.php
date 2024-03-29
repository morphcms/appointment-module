<?php

namespace Modules\Appointment\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Modules\Appointment\Nova\Resources\Meeting;
use Modules\Appointment\Nova\Resources\MeetingGuest;

class AppointmentTool extends Tool
{
    protected static array $resources = [
        Meeting::class,
        MeetingGuest::class,
    ];

    public function boot()
    {
        Nova::resources(static::$resources);
    }

    public function menu(Request $request)
    {
        return MenuSection::resource(Meeting::class)
            ->icon('identification')
            ->canSee(fn () => true);
    }
}

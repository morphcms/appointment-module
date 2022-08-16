<?php

namespace Modules\Appointment\Listeners;

use Modules\Appointment\Nova\AppointmentTool;
use Wdelfuego\NovaCalendar\NovaCalendar;

class RegisterAppointmentNovaTool
{
    public function __invoke($event): array
    {
        return [
            AppointmentTool::make(),
            NovaCalendar::make(),
        ];
    }
}

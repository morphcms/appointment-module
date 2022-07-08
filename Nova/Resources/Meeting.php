<?php

namespace Modules\Appointment\Nova\Resources;

use App\Nova\User;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Modules\Appointment\Enum\MeetingStatus;

class Meeting extends Resource
{

    public static $model = \Modules\Appointment\Models\Meeting::class;

    public static $title = 'title';

    public static $displayInNavigation = true;

    public static $search = [
        'id',
    ];

    /**
     * @inheritDoc
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Title'),

            Textarea::make('Notes')
                ->rows(2),

            DateTime::make('Starts At')
                ->rules(['required', 'after:yesterday']),

            DateTime::make('Ends At')
                ->rules(['after_or_equal:starts_at']),

            Select::make('Status')
                ->options(MeetingStatus::options(true))
                ->onlyOnForms()
                ->displayUsingLabels(),

            Badge::make('Status')
                ->displayUsing(fn() => MeetingStatus::from($this->status)->value)
                ->map(MeetingStatus::getNovaBadgeColors())
                ->exceptOnForms(),

            BelongsTo::make('User', 'user', User::class),
        ];
    }
}

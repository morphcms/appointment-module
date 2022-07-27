<?php

namespace Modules\Appointment\Nova\Resources;

use App\Nova\User;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Modules\Appointment\Enum\MeetingStatus;
use Modules\Morphling\Nova\Actions\UpdateStatus;
use Modules\Morphling\Nova\Filters\ByStatus;

class Meeting extends Resource
{

    public static $model = \Modules\Appointment\Models\Meeting::class;

    public static $title = 'title';

    public static $displayInNavigation = false;

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

            Badge::make('Status')
                ->displayUsing(fn() => MeetingStatus::from($this->status)->value)
                ->map(MeetingStatus::getNovaBadgeColors())
                ->exceptOnForms(),

            BelongsTo::make('User', 'user', User::class),

            HasMany::make('Guests', 'guests', MeetingGuest::class),
        ];
    }

    public function actions(NovaRequest $request): array
    {
        return [
            UpdateStatus::make(MeetingStatus::class)->showInline(),
        ];
    }

    public function filters(NovaRequest $request): array
    {
        return [
            ByStatus::make(MeetingStatus::class),
        ];
    }
}

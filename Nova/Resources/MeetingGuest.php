<?php

namespace Modules\Appointment\Nova\Resources;

use App\Nova\User;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class MeetingGuest extends Resource
{

    public static string $model = \Modules\Appointment\Models\MeetingGuest::class;

    public static $title = 'email';

    public static $displayInNavigation = false;

    public static $search = [
        'id',
    ];

    /**
     * @inheritDoc
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Email')->rules([
                'nullable',
                'prohibited_unless:user_id,null',
            ]),

            DateTime::make('Accepted At'),

            BelongsTo::make('User', 'user', User::class)
                ->nullable()
                ->rules([
                    'nullable',
                    'prohibited_unless:email,null',
                ]),

            BelongsTo::make('Meeting', 'meeting', Meeting::class),
        ];
    }
}

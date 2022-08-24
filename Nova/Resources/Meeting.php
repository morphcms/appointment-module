<?php

namespace Modules\Appointment\Nova\Resources;

use App\Nova\User;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Modules\Acl\Services\AclService;
use Modules\Appointment\Enum\MeetingStatus;
use Modules\Morphling\Nova\Actions\UpdateStatus;
use Modules\Morphling\Nova\Filters\ByStatus;

class Meeting extends Resource
{
    public static string $model = \Modules\Appointment\Models\Meeting::class;

    public static $title = 'title';

    public static $displayInNavigation = false;

    public static $search = [
        'id',
    ];

    /**
     * {@inheritDoc}
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Title'),

            Textarea::make('Notes')
                ->rows(2),

            Stack::make('Dates', [
                Line::make('Starts At', fn () => 'Starts At: '.$this->model()->starts_at->toDayDateTimeString()),

                Line::make('Ends At', fn () => 'Ends At: '.$this->model()->ends_at?->toDayDateTimeString()),
            ]),

            DateTime::make('Starts At')
                ->rules(['required', 'after:yesterday'])
                ->onlyOnForms(),

            DateTime::make('Ends At')
                ->rules(['after_or_equal:starts_at'])
                ->onlyOnForms(),

            Badge::make('Status')
                ->displayUsing(fn () => MeetingStatus::from($this->status)->value)
                ->map(MeetingStatus::getNovaBadgeColors())
                ->exceptOnForms(),

            BelongsTo::make('User', 'user', User::class),

            HasMany::make('Guests', 'guests', MeetingGuest::class),

            Url::make('Chat link', function () {
                $url = config('app.url');
                $chat_id = $this->model()->chat_id;

                return "$url/messenger/$chat_id";
            })->displayUsing(fn () => 'View Conversation'),

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

    /**
     * Build an "index" query for the given resource.
     *
     * @param  NovaRequest  $request
     * @param  Builder  $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        if ($request->user()->hasAnyRole([
            AclService::superAdminRole(),
            AclService::adminRole(),
        ])) {
            return $query;
        }

        return $query->with(['guests', 'user'])
            ->whereHas('guests', function ($query) use ($request) {
                return $query->where('id', $request->user()->id);
            })
            ->orWhere('user_id', $request->user()->id);
    }
}

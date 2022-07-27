<?php

namespace Modules\Appointment\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Appointment\Database\factories\MeetingFactory;
use Modules\Appointment\Enum\MeetingStatus;


/**
 * Modules\Appointment\Models\Meeting
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $starts_at
 * @property \Illuminate\Support\Carbon|null $ends_at
 * @property string|null $notes
 * @property string $status
 * @property string|null $title
 * @property string|null $uuid
 * @property string|null $chat_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Appointment\Models\MeetingGuest[] $guests
 * @property-read int|null $guests_count
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting approved()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereUuid($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting status(\Modules\Appointment\Enum\MeetingStatus $status)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereChatId($value)
 */
class Meeting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function hasStatus($status): bool
    {
        return $this->status === $status->value;
    }

    public function scopeStatus($query, MeetingStatus $status)
    {
        return $query->whereStatus($status->value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function guests(): HasMany
    {
        return $this->hasMany(MeetingGuest::class);
    }
}

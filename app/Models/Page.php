<?php

namespace App\Models;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $title
 * @property string|null $body
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @property int $slug_id
 * @property-read \App\Models\Slug $slug
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlugId($value)
 * @property int $owner_id
 * @property-read \App\Models\Account $owner
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereOwnerId($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
    use HasFactory, BroadcastsEvents;

    protected $fillable = [
        'owner_id',
        'title',
        'body',
    ];

    public function broadcastOn(string $event): array
    {
        return [
            new Channel('pages'),
        ];
    }

    public function slug(): HasOne
    {
        return $this->hasOne(Slug::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'owner_id');
    }
}

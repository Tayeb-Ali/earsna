<?php

namespace App\Models\Admin;

use App\Models\Hall;
use App\Models\User;
use Database\Factories\Admin\ClientFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin\Client
 *
 * @property int $id
 * @property string|null $address
 * @property int $business_field_id
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read BusinessField|null $businessField
 * @property-read Collection|Hall[] $halls
 * @property-read int|null $halls_count
 * @property-read Subscription|null $subscription
 * @property-read User|null $user
 * @method static ClientFactory factory(...$parameters)
 * @method static Builder|Client newModelQuery()
 * @method static Builder|Client newQuery()
 * @method static Builder|Client query()
 * @method static Builder|Client whereAddress($value)
 * @method static Builder|Client whereBusinessFieldId($value)
 * @method static Builder|Client whereCreatedAt($value)
 * @method static Builder|Client whereId($value)
 * @method static Builder|Client whereUpdatedAt($value)
 * @method static Builder|Client whereUserId($value)
 * @mixin Eloquent
 */
class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = 'user';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    public function businessField(): BelongsTo
    {
        return $this->belongsTo(BusinessField::class);
    }

    public function halls(): HasMany
    {
        return $this->hasMany(Hall::class);
    }
}

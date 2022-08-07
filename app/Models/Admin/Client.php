<?php

namespace App\Models\Admin;

use App\Models\Hall;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Client
 *
 * @property int $id
 * @property string|null $address
 * @property int $business_field_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin\BusinessField|null $businessField
 * @property-read \Illuminate\Database\Eloquent\Collection|Hall[] $halls
 * @property-read int|null $halls_count
 * @property-read \App\Models\Admin\Subscription|null $subscription
 * @property-read User|null $user
 * @method static \Database\Factories\Admin\ClientFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereBusinessFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUserId($value)
 * @mixin \Eloquent
 */
class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = 'user';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function businessField()
    {
        return $this->belongsTo(BusinessField::class);
    }

    public function halls()
    {
        return $this->hasMany(Hall::class);
    }
}

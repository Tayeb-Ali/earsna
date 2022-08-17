<?php

namespace App\Models\Admin;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin\Package
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Feature[] $features
 * @property-read int|null $features_count
 * @property-read Collection|Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static Builder|Package newModelQuery()
 * @method static Builder|Package newQuery()
 * @method static Builder|Package query()
 * @method static Builder|Package whereCreatedAt($value)
 * @method static Builder|Package whereId($value)
 * @method static Builder|Package whereName($value)
 * @method static Builder|Package wherePrice($value)
 * @method static Builder|Package whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that should be guarded.
     *
     * @var array<string, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'integer'
    ];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    protected function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    protected function getPriceAttribute()
    {
        return $this->attributes['price'] / 100;
    }
}

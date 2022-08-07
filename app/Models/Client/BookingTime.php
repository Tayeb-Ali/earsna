<?php

namespace App\Models\Client;

use App\Models\Client\Hall;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Client\BookingTime
 *
 * @property int $id
 * @property string $period
 * @property string $from
 * @property string $to
 * @property int $hall_id
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime whereHallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTime whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BookingTime extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function getPriceAttribute()
    {
        return $this->attributes['price'] / 100;
    }
}

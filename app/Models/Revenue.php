<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Revenue
 *
 * @property int $id
 * @property string $description
 * @property string $payment_method
 * @property \Illuminate\Support\Carbon $date
 * @property int $amount
 * @property string $status
 * @property int|null $hall_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue query()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereHallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Revenue extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date' => 'date'
    ];

    public function getAmountAttribute()
    {
        return $this->attributes['amount'] / 100;
    }

    public function setAmountAttribute($value)
    {
        return $this->attributes['amount'] = $value * 100;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Report
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $from
 * @property \Illuminate\Support\Carbon $to
 * @property string $type
 * @property int $average
 * @property int $total
 * @property int|null $hall_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereHallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Report extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'from' => 'date',
        'to' => 'date'
    ];

    protected function setAverageAttribute($value)
    {
        $this->attributes['average'] = $value * 100;
    }

    protected function getAverageAttribute()
    {
        return $this->attributes['average'] / 100;
    }

    protected function setTotalAttribute($value)
    {
        $this->attributes['total'] = $value * 100;
    }

    protected function getTotalAttribute()
    {
        return $this->attributes['total'] / 100;
    }
}

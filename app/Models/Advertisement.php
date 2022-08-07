<?php

namespace App\Models;

use App\Models\Admin\BusinessField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Advertisement
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property int $price
 * @property string $status
 * @property string $owner_name
 * @property string $owner_phone
 * @property string|null $images
 * @property int $business_field_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read BusinessField|null $businessField
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereBusinessFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereOwnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereOwnerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advertisement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Advertisement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    public function businessField()
    {
        return $this->belongsTo(BusinessField::class, 'business_field_id');
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

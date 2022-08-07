<?php

namespace App\Models;

use App\Models\Client\BookingTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hall
 *
 * @property int $id
 * @property string $name
 * @property string $city
 * @property string $address
 * @property string $capacity
 * @property string|null $images
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|BookingTime[] $bookingTimes
 * @property-read int|null $booking_times_count
 * @property-read \App\Models\Admin\Client|null $client
 * @method static \Illuminate\Database\Eloquent\Builder|Hall newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Hall extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(\App\Models\Admin\Client::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function bookingTimes()
    {
        return $this->hasMany(BookingTime::class);
    }

    public function hasSettings()
    {
        return Setting::where('hall_id', $this->id)->exists();
    }
}

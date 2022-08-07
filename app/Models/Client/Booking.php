<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Client\Booking
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property int|null $customer_id
 * @property int|null $bookingTime_id
 * @property int $offer_id
 * @property int $service_id
 * @property string $payment_method
 * @property string|null $paid
 * @property string $remaining
 * @property int $total
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client\BookingTime|null $bookingTime
 * @property-read \App\Models\Client\Customer|null $customer
 * @property mixed $paid_amount
 * @property mixed $remaining_amount
 * @property-read \App\Models\Client\Offer|null $offer
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereRemaining($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
    ];

    protected $with = ['bookingTime'];

    public function bookingTime()
    {
        return $this->belongsTo(BookingTime::class, 'bookingTime_id');
    }

    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = $value * 100;
    }

    public function getTotalAttribute()
    {
        return $this->attributes['total'] / 100;
    }

    public function setPaidAmountAttribute($value)
    {
        $this->attributes['paid'] = $value * 100;
    }

    public function getPaidAmountAttribute()
    {
        return $this->attributes['paid'] / 100;
    }

    public function setRemainingAmountAttribute($value)
    {
        $this->attributes['remaining'] = $value * 100;
    }

    public function getRemainingAmountAttribute()
    {
        return $this->attributes['remaining'] / 100;
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

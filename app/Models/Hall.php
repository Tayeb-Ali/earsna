<?php

namespace App\Models;

use App\Models\Admin\Client;
use App\Models\Client\BookingTime;
use App\Models\Client\Customer;
use App\Models\Client\Offer;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|BookingTime[] $bookingTimes
 * @property-read int|null $booking_times_count
 * @property-read Client|null $client
 * @method static Builder|Hall newModelQuery()
 * @method static Builder|Hall newQuery()
 * @method static Builder|Hall query()
 * @method static Builder|Hall whereAddress($value)
 * @method static Builder|Hall whereCapacity($value)
 * @method static Builder|Hall whereCity($value)
 * @method static Builder|Hall whereClientId($value)
 * @method static Builder|Hall whereCreatedAt($value)
 * @method static Builder|Hall whereId($value)
 * @method static Builder|Hall whereImages($value)
 * @method static Builder|Hall whereName($value)
 * @method static Builder|Hall whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Hall extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function booking_times(): HasMany
    {
        return $this->hasMany(BookingTime::class);
    }

    public function hasSettings(): bool
    {
        return Setting::where('hall_id', $this->id)->exists();
    }

    public function revenues(): HasMany
    {
        return $this->hasMany(Revenue::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
    public function expense(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Booking;
use App\Models\Client\BookingTime;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AvailableBookingTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, Hall $hall)
    {
        $bookings_bookingTimes = [];

        $hall_bookingTimes = BookingTime::where('hall_id', $hall->id)
            ->where('period', $request->period)
            ->get();

        $formatted_date = substr(Carbon::create($request->date), 0, 10);

        $bookings = Booking::where('date', $formatted_date)
            ->whereIn('status', ['confirmed', 'temporary'])
            ->whereHas('bookingTime', function ($query) use ($request, $hall) {
                $query
                    ->where('hall_id', $hall->id)
                    ->where('period', $request->period);
            })->get();

        if ($bookings) {
            foreach ($bookings as $booking) {
                $bookings_bookingTimes[] = $booking->bookingTime->id;
            }
        }

        $available = $hall_bookingTimes->filter(fn($value) => !in_array($value->id, $bookings_bookingTimes));

        if ($available->count() > 0) {
            return response()->json(['times' => $available->toArray(), "status"=>true], 200);
        } else {
            return response()->json(['no_times' => __('page.bookingTimes.flash.unavailable')], 200);
        }
    }
}

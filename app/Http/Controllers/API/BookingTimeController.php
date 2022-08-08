<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client\Booking;
use App\Models\Client\BookingTime;
use Illuminate\Http\Request;

class BookingTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings_bookingTimes = [];

        $hall_bookingTimes = BookingTime::where('hall_id', request('hall'))
            ->where('period', request('period'))->get();

        $bookings = Booking::where('date', request('date'))
            ->whereHas('bookingTime', function ($query) {
                $query
                    ->where('hall_id', request('hall'))
                    ->where('period', '=', request('period'));
            })->get();

        if ($bookings) {
            foreach ($bookings as $booking) {
                $bookings_bookingTimes[] = $booking->bookingTime;
            }
        }

        $available = $hall_bookingTimes->filter(function ($value) use ($bookings_bookingTimes) {
            return !in_array($value, $bookings_bookingTimes);
        });

        return response()->json(['times' => $available->toArray()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BookingTime $bookingTime
     * @return \Illuminate\Http\Response
     */
    public function show(BookingTime $bookingTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BookingTime $bookingTime
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingTime $bookingTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BookingTime $bookingTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingTime $bookingTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BookingTime $bookingTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingTime $bookingTime)
    {
        //
    }
}

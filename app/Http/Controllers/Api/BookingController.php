<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NewBookingRequest;
use App\Http\Requests\Api\UpdateBookingRequest;
use App\Models\Client\Booking;
use App\Models\Client\BookingTime;

class BookingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewBookingRequest $request)
    {
        Booking::create($request->validated() + ['user_id' => auth()->id()]);

        return response(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return response()->json(['booking' => $booking]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->update($request->validated());

        return response()->json([
            'request' => $request->validated()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return response()->json(200);
    }
}

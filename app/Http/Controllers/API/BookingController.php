<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NewBookingRequest;
use App\Http\Requests\Api\UpdateBookingRequest;
use App\Models\Client\Booking;
use App\Models\Client\BookingTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::paginate();
        return response()->json($bookings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(NewBookingRequest $request)
    {
        $request->validated();
        $input = $request->all();
        Booking::create($input);

        return response()->json(['status' => true, 'message' => 'Booking created successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Booking $booking
     * @return JsonResponse
     */
    public function show(Booking $booking)
    {
        return response()->json(['booking' => $booking]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookingRequest $request
     * @param Booking $booking
     * @return JsonResponse
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
     * @param Booking $booking
     * @return JsonResponse
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return response()->json(200);
    }
}

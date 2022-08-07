<?php

namespace App\Http\Controllers\Client;

use App\Events\MadeBookingPayment;
use App\Events\RevenueCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\NewBookingRequest;
use App\Http\Requests\Client\UpdateBookingRequest;
use App\Models\Client\Booking;
use App\Models\Client\Customer;
use App\Models\Hall;
use App\Models\Client\Offer;
use App\Models\Client\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function __construct()
    {
        if (!Session::get('hall')) {
            return redirect()->route('halls.index');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $hall_id = $id;
        $bookings = Booking::latest()->paginate(30);

        return view('client.bookings.index', compact('bookings', 'hall_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
//        return $id;
        $offers = Offer::all();
        $services = Service::all();
        $customers = Customer::whereHas('user', function ($query) use ($id) {
            $query->where('hall_id', $id);
        })->get();

        return view('client.bookings.create', compact('offers', 'customers', 'services', 'id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(NewBookingRequest $request, $id)
    {
        $booking = Booking::create($request->validated());

        event(new RevenueCreated($booking));

        return redirect()
            ->route('halls.bookings.index', $id)
            ->withMessage(__('page.bookings.flash.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Booking $booking
     * @return Application|Factory|ViewAlias
     */
    public function show(Hall $hall, Booking $booking)
    {
        $hall->client->user->notifications->markAsRead();

        return view('client.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Booking $booking
     * @return Response
     */
    public function edit(Hall $hall, Booking $booking)
    {
        $offers = Offer::all();
        $services = Service::all();
        return view('client.bookings.edit', compact('offers', 'services', 'booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Booking $booking
     * @return Response
     */
    public function update(UpdateBookingRequest $request, Hall $hall, Booking $booking, $id)
    {
        $attributes = $request->except(['date', 'bookingTime_id']);

        if ($date = $request->date) {
            $attributes['date'] = $date;
        }

        if ($request->has('bookingTime_id')) {
            $attributes['bookingTime_id'] = $request->bookingTime_id;
        }

        $booking->update($attributes);

        return redirect()
            ->route('halls.bookings.index', $id)
            ->withMessage(__('page.bookings.flash.updated', ['booking' => $booking->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Booking $booking
     * @return Response
     */
    public function destroy(Hall $hall, Booking $booking, $id)
    {
        $booking_id = $booking->id;

        $booking->delete();

        return redirect()
            ->route('halls.bookings.index', $id)
            ->withMessage(__('page.bookings.flash.deleted', ['booking' => $booking_id]));
    }

    public function makePayment(Request $request, Hall $hall, Booking $booking)
    {
        $request->validate([
            'paid' => ['required', 'numeric'],
            'invoice' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ]);

        $paid = $booking->paid + $request->paid;
        $remaining = $booking->remaining - $request->paid;

        $booking->update(['paid' => $paid, 'remaining' => $remaining]);

        event(new MadeBookingPayment($paid, now(), $booking));
    }
}

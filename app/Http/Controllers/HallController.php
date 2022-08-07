<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\{NewHallRequest, UpdateHallRequest};
use App\Models\Admin\Client;
use App\Models\Client\{Booking, BookingTime, Customer, Offer};
use App\Models\{Expense, Hall, Report, Revenue, Setting, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->user()->isClient()) {
            $client = Client::findOrFail(request()->user()->client_id);

            $halls = $client->halls;

            if (session()->has('hall')) {
                session()->forget('hall');
            }

            return view('halls.select', compact('halls'));
        } else {
            $halls = Hall::latest()->paginate(30);

            return view('halls.index', compact('halls'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $target_client = $request->target_client_id ? Client::find($request->target_client_id) : null;

        $clients = Client::all();

        return view('halls.create', compact('target_client', 'clients'));
    }

    public function store(NewHallRequest $request)
    {
        $data = $request->except('images');

        if ($request->has('images')) {
            $images = [];

            foreach ($request->images as $image) {
                $images[] = $image->store('images/halls');
            }

            $data['images'] = json_encode($images);
        }

        Hall::create($data);

        return redirect()
            ->route('halls.index')
            ->withMessage(__('page.halls.flash.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Hall $hall
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall)
    {
        return view('halls.edit', compact('hall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Hall $hall
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHallRequest $request, Hall $hall)
    {
        $hall->update($request->except('images'));

        if ($request->has('images')) {
            $images = [];

            foreach (json_decode($hall->images) as $image) {
                if (File::exists($image)) {
                    File::delete($image);
                }
            }

            foreach ($request->images as $image) {
                $images[] = $image->store('images/halls');
            }

            $hall->images = json_encode($images);
        }

        return redirect()
            ->route('halls.index')
            ->withMessage(__('page.halls.flash.updated', ['hall' => $hall->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        $name = $hall->name;
        // Delete bookings notifications

        $this->deleteBookings($hall);

        $this->deleteBookingTimes($hall);

        $this->deleteOffers($hall);

        $this->deleteCustomers($hall);

        $this->deleteExpenses($hall);

        $this->deleteRevenues($hall);

        $this->deleteReports($hall);

        $this->deleteUsers($hall);

        $this->deleteSettings($hall);

        $hall->delete();

        return redirect()->route('halls.index')
            ->withMessage(__('page.halls.flash.deleted', ['hall' => $name]));
    }

    protected function deleteBookings($hall)
    {
        $bookings = Booking::whereHas('bookingTime', function ($query) use ($hall) {
            $query->where('hall_id', $hall->id);
        })->get();

        foreach ($bookings as $booking) {
            $booking->delete();
        }
    }

    protected function deleteBookingTimes($hall)
    {
        BookingTime::where('hall_id', $hall->id)->get();
    }

    protected function deleteOffers($hall)
    {
        $offers = Offer::where('hall_id', $hall->id)->get();

        foreach ($offers as $offer) {
            $offer->delete();
        }
    }

    protected function deleteCustomers($hall)
    {
        $customers = Customer::where('hall_id', $hall->id)->get();

        foreach ($customers as $customer) {
            $customer->delete();
        }
    }

    protected function deleteExpenses($hall)
    {
        $expenses = Expense::where('hall_id', $hall->id)->get();

        foreach ($expenses as $expense) {
            $expense->delete();
        }
    }

    protected function deleteRevenues($hall)
    {
        $revenues = Revenue::where('hall_id', $hall->id)->get();

        foreach ($revenues as $revenue) {
            $revenue->delete();
        }
    }

    protected function deleteReports($hall)
    {
        $reports = Report::where('hall_id', $hall->id)->get();

        foreach ($reports as $report) {
            $report->delete();
        }
    }

    protected function deleteUsers($hall)
    {
        $users = User::where('hall_id', $hall->id)->get();

        foreach ($users as $user) {
            $user->delete();
        }
    }

    protected function deleteSettings($hall)
    {
        $settings = Setting::where('hall_id', $hall->id)->get();

        foreach ($settings as $setting) {
            $setting->delete();
        }
    }
}

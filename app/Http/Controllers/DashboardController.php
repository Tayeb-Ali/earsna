<?php

namespace App\Http\Controllers;

use App\Models\Client\Booking;
use App\Models\Expense;
use App\Models\Hall;
use App\Models\Revenue;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function showHallDashboard(Hall $hall)
    {
        // Set the current hall and initialize its settings
        Session::put('hall', $hall);
        $this->initializeHallSettings($hall);

        // Get all the bookings of the current hall
        $bookings = Booking::whereHas('bookingTime', function ($query) use ($hall) {
                        $query->where('hall_id', $hall->id);
                    })->get();

        // Get all the revenues of the current hall
        $revenues = Revenue::where('hall_id', $hall->id)->get();
        // Get the sum of all the revenues
        $revenues_amount = $this->calculateSum($revenues);
        // Get the sum of the revenues that have been collected of the current hall
        $collected_revenues_amount = $this->calculateSum($revenues->where('status', 'collected')->all());
        // Get the sum of the revenues that have not yet been collected of the current hall
        $uncollected_revenues_amount = $this->calculateSum($revenues->where('status', 'uncollected')->all());

        // Get the sum of the expenses of the current hall
        $expenses_amount = $this->calculateSum(Expense::where('hall_id', $hall->id)->get());

        // Number of bookings in the last five months
        $months = [];
        foreach (range(4, 0, -1) as $i) {
            // Get target month
            $month = Carbon::now()->subMonth($i);
            // Get target month name
            $months['labels'][] = $month->format('M');
            // Get bookings count of target month
            $months['data'][] = $bookings->where('date', '>', $month->subMonth())
                                        ->where('date', '<', $month->addMonth())
                                        ->count();
        }

        return view('halls.dashboard', [
            'events' => json_encode($this->getEvents()),
            'bookings' => $bookings->count(),
            'temporary_bookings' => $bookings->where('status', 'temporary')->count(),
            'confirmed_bookings' => $bookings->where('status', 'confirmed')->count(),
            'paid_bookings' => $bookings->where('status', 'paid')->count(),
            'canceled_bookings' => $bookings->where('status', 'canceled')->count(),
            'revenues' => $revenues_amount,
            'collected_revenues' => $collected_revenues_amount,
            'uncollected_revenues' => $uncollected_revenues_amount,
            'expenses' => $expenses_amount,
            'months' => $months
        ]);
    }

    public function showAdminDashboard()
    {
        return view('admin.dashboard');
    }

    protected function getEvents()
    {
        $events = [];

        $bookings = Booking::whereHas('bookingTime', function ($query) {
                        $query->where('hall_id', Session::get('hall')->id);
                    })->whereIn('status', ['confirmed', 'temporary'])->get();

        foreach ($bookings as $key => $booking) {
            $events[$key]['title'] = $booking->customer_name;
            $events[$key]['start'] = $booking->date->setTimeFromTimeString($booking->bookingTime->from)->toDateTimeString();
            $events[$key]['end'] = $booking->date->setTimeFromTimeString($booking->bookingTime->to)->toDateTimeString();
        }

        return $events;
    }

    protected function initializeHallSettings($hall)
    {
        if (! $hall->hasSettings()) {
            $settings = [
                ['name' => 'days_before_booking_due_date', 'value' => '14', 'hall_id' => $hall->id],
            ];
            foreach ($settings as $setting) {
                Setting::create($setting);
            }
        }
    }

    protected function calculateSum($data)
    {
        $sum = 0;

        foreach ($data as $item) {
            $sum += $item->amount;
        }

        return $sum;
    }
}

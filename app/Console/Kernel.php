<?php

namespace App\Console;

use App\Models\Client\Booking;
use App\Models\Client\BookingTime;
use App\Models\Hall;
use App\Models\Setting;
use App\Notifications\BookingBeforeDueDateNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            if (session()->has('hall')) {
                $booking_times = BookingTime::where('hall_id', Session::get('hall')->id)->get();
                $days = Setting::where('name', 'booking_before_due_date_days')
                                    ->where('hall_id', Session::get('hall')->id)
                                    ->first()->value;

                foreach ($booking_times as $time) {
                    Booking::where('bookingTime_id', $time->id)
                        ->whereIn('status', ['confirmed', 'temporary'])
                        ->chunk(100, function ($bookings) use ($days) {
                            foreach ($bookings as $booking) {
                                if ($booking->created_at->addDays($days)->greaterThanOrEqual($booking->date)) {
                                    Hall::find(Session::get('hall')->id)
                                        ->client->user->notify(new BookingBeforeDueDateNotification($booking, $days));
                                }
                            }
                        });
                }
            }
        })->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Listeners;

use App\Models\Revenue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RevenueCreatedEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Revenue::create([
            'date' => $event->booking->created_at,
            'payment_method' => $event->booking->payment_method,
            'amount' => $event->booking->total,
            'description' => app()->getLocale() === 'ar' ? 'حجز جديد' : 'New Booking',
            'hall_id' => $event->booking->bookingTime->hall_id
        ]);
    }
}

<?php

namespace App\Listeners;

use App\Models\Revenue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MadeBookingPaymentEventListener
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
            'date' => $event->date,
            'payment_method' => $event->booking->payment_method,
            'amount' => $event->amount,
            'description' => app()->getLocale() === 'ar' ? 'تمت عملية دفع للحجز رقم ' . $event->booking->id : 'Payment process for the booking number ' . $event->booking->id,
            'hall_id' => $event->booking->bookingTime->hall_id
        ]);
    }
}

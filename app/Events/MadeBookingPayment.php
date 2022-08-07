<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MadeBookingPayment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $paid;
    protected $date;
    protected $booking;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($amount, $date, $booking)
    {
        $this->amount = $amount;
        $this->date = $date;
        $this->booking = $booking;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

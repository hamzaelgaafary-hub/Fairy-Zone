<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderConfirmationEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

        // لتحديد طابور معين (اختياري)
    public $queue = 'emails';


    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event): void
    {
        // OrderConfirmationMail has no constructor arguments, instantiate without passing the order
        Mail::to($event->order->user->email)
            ->send(new OrderConfirmationMail($event->order));
    }
}

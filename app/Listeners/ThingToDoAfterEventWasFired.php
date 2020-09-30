<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ThingToDoAfterEventWasFired
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
     * @param OrderPlaced $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        // sending an email to the customer
        $email = $event->params['email'];

        Mail::send('emails.invoice', array(
            'user_response'    => $event->params['user_response'],
            'product_response' => $event->params['product_response'],
            'order_data'       => $event->params['order_data']
        ), function ($message) use ($email) {
            $message
                ->to($email)
                ->subject('New Order Request');
        });
    }
}

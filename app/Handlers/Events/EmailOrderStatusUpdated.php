<?php

namespace App\Handlers\Events;

use App\Events\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailOrderStatusUpdated
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
     * @param  OrderStatusUpdated  $event
     * @return void
     */
    public function handle(OrderStatusUpdated $event)
    {
        $subject = 'Your Order # ' . $event->getOrderId() . ' is '. $event->getOrderStatusName();

        $message = 'Your Order # ' . $event->getOrderId() . ' is '. $event->getOrderStatusName();

        return Mail::send('emails.customer-account', ['name' => $event->getName(), 'messageBody' => $message], function ($message) use ($subject, $event) {
          // note: if you don't set this, it will use the defaults from config/mail.php
          // $message->from('admin@goodhealth.com', 'Admin Goodhealth');
          $message->to($event->getEmail(), $event->getName())
          ->subject($subject);
      });
}
}

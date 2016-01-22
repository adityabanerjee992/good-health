<?php

namespace App\Handlers\Events;

use Illuminate\Support\Facades\Mail;
use App\Events\CustomerOrderRejected;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailCustomerOrderRejected
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  CustomerOrderRejected  $event
     * @return void
     */
    public function handle(CustomerOrderRejected $event)
    {
        $subject = 'Your Order # ' . $event->getOrderId() . ' has been rejected';

        $message = 'Your Order # ' . $event->getOrderId() . ' has been rejected'. '<br/>'
                   .'<strong> Reason For Rejection : </strong>'
                   .$event->getRejectionReason(). '<br/>';
                 

        return Mail::send('emails.customer-account', ['name' => $event->getName(), 'messageBody' => $message], function ($message) use ($subject, $event) {
          // note: if you don't set this, it will use the defaults from config/mail.php
          $message->from('admin@goodhealth.com', 'Admin Goodhealth');
          $message->to($event->getEmail(), $event->getName())
            ->subject($subject);
        });
    }
}

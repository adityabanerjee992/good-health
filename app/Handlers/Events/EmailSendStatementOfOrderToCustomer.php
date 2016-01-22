<?php

namespace App\Handlers\Events;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SendStatementOfOrderToCustomer;

class EmailSendStatementOfOrderToCustomer
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
     * @param  SendStatementOfOrderToCustomer  $event
     * @return void
     */
    public function handle(SendStatementOfOrderToCustomer $event)
    {
        $subject = 'Statement Of Your Recent Order Placed At SRS GoodHealth';
        $message = 'Statement Of Your Recent Order Placed At SRS GoodHealth';

        return Mail::send('emails.statement-of-order', ['companies' => $event->getCompanies(), 
                                                      'userAddress' => $event->getUserAddress(),
                                                      'orderStatus' => $event->getOrderStatus(),
                                                      'orderDetails' => $event->getOrderDetails(),
                                                      'paymentTypeDetails' => $event->getPaymentTypeDetails()],
                                                       function ($message) use ($subject, $event) {
          // note: if you don't set this, it will use the defaults from config/mail.php
          // $message->from('admin@goodhealth.com', 'Admin Goodhealth');
          $message->to($event->getEmail(), $event->getName())
          ->subject($subject);
         });
    }
}

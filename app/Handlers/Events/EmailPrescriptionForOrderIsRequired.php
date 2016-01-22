<?php

namespace App\Handlers\Events;

use Illuminate\Support\Facades\Mail;
use App\Events\PrescriptionForOrderIsRequired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailPrescriptionForOrderIsRequired
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
     * @param  PrescriptionForOrderIsRequired  $event
     * @return void
     */
    public function handle(PrescriptionForOrderIsRequired $event)
    {
        $subject = 'Important !!. Prescription For Your Order Is Required !!';
        $message= 'Thank you for placing your order at GoodHealth. But before we process your request, we found that to fullfill your  : '. '<br/>'
                  .'order, we need the doctor prescription for your Order Number : # '. $event->getOrderId()
                  .'So we request you to upload the prescription asap.'. '<br/>';
                 

        return Mail::send('emails.customer-account', ['name' => $event->getName(), 'messageBody' => $message], function ($message) use ($subject, $event) {
          // note: if you don't set this, it will use the defaults from config/mail.php
          $message->from('admin@goodhealth.com', 'Admin Goodhealth');
          $message->to($event->getEmail(), $event->getName())
            ->subject($subject);
        });
    }
}

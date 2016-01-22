<?php

namespace App\Handlers\Events;

use Illuminate\Support\Facades\Mail;
use App\Events\CustomerAccountSuspended;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAccountSuspension implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event handler.
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
     * @param  CustomerAccountSuspended  $event
     * @return void
     */
    public function handle(CustomerAccountSuspended $event)
    {   
        $subject = 'Account Suspended!';
        $message= 'Your account has been suspended . please contact the customer support for further assistance';


        return Mail::send('emails.customer-account', ['name' => $event->getName() , 'messageBody' => $message], function($message) use ($subject,$event) {
          // note: if you don't set this, it will use the defaults from config/mail.php
          $message->from('admin@goodhealth.com', 'Admin Goodhealth');
          $message->to($event->getEmail(), $event->getName())
            ->subject($subject);
        });
    }
}

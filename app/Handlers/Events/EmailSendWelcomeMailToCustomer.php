<?php

namespace App\Handlers\Events;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendWelcomeMailToCustomer;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSendWelcomeMailToCustomer
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
     * @param  SendWelcomeMailToCustomer  $event
     * @return void
     */
    public function handle(SendWelcomeMailToCustomer $event)
    {
        $subject = 'Welcome To SRS GoodHealth';
        $message = 'Welcome To SRS GoodHealth';

        return Mail::send('emails.signup', ['name' => $event->getName()],
                                                       function ($message) use ($subject, $event) {
          // note: if you don't set this, it will use the defaults from config/mail.php
          // $message->from('admin@goodhealth.com', 'Admin Goodhealth');
          $message->to($event->getEmail(), $event->getName())
          ->subject($subject);
         });

    }
}

<?php

namespace App\Handlers\Events;

use Illuminate\Support\Facades\Mail;
use App\Events\ChemistAccountCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailChemistAccountInformation
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
     * @param  ChemistAccountCreated  $event
     * @return void
     */
    public function handle(ChemistAccountCreated $event)
    {
        $subject = 'Chemist Account Created !!';
        $message= 'Your Chemist account has been created . You can login using the following information : '. '<br/>'
                  .'Username  : '.$event->getEmail() . '<br/>'
                  .'Password  : '. $event->getPassword();


        return Mail::send('emails.customer-account', ['name' => $event->getName() , 'messageBody' => $message], function($message) use ($subject,$event) {
          // note: if you don't set this, it will use the defaults from config/mail.php
          $message->from('admin@goodhealth.com', 'Admin Goodhealth');
          $message->to($event->getEmail(), $event->getName())
            ->subject($subject);
        });
    }
}

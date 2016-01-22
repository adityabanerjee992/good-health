<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],  
        'App\Events\CustomerAccountSuspended' => [
            'App\Handlers\Events\EmailAccountSuspension',
        ],
        'App\Events\CustomerAccountActivated' => [
            'App\Handlers\Events\EmailAccountActivation',
        ],  
        'App\Events\ChemistAccountCreated' => [
            'App\Handlers\Events\EmailChemistAccountInformation',
        ],
        'App\Events\PrescriptionForOrderIsRequired' => [
            'App\Handlers\Events\EmailPrescriptionForOrderIsRequired',
        ],   
        'App\Events\PrescriptionUpdateForOrderIsRequired' => [
            'App\Handlers\Events\EmailPrescriptionUpdateForOrderIsRequired',
        ],        
        'App\Events\CustomerOrderRejected' => [
            'App\Handlers\Events\EmailCustomerOrderRejected',
        ],        
        'App\Events\OrderStatusUpdated' => [
            'App\Handlers\Events\EmailOrderStatusUpdated',
        ], 
        'App\Events\SendStatementOfOrderToCustomer' => [
            'App\Handlers\Events\EmailSendStatementOfOrderToCustomer',
        ],   
        'App\Events\SendWelcomeMailToCustomer' => [
            'App\Handlers\Events\EmailSendWelcomeMailToCustomer',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}

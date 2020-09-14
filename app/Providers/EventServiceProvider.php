<?php
namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        'App\Events\StorePayment' => [
            'App\Listeners\PaymentVerification',
        ],
        'App\Events\LoginVerification' => [
            'App\Listeners\UserEventListener',
        ],
        'App\Events\StoreCharge' => [
            'App\Listeners\ChargeVerification',
        ]
    ];

    public function boot()
    {
        parent::boot();
    }
}

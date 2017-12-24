<?php

namespace Salador\Uslugi\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Salador\Uslugi\Events\ServiceEvent;
use Salador\Uslugi\Events\MasterEvent;
use Salador\Uslugi\Events\PriceEvent;

use Salador\Uslugi\Listeners\Services\ServiceBaseListener;
use Salador\Uslugi\Listeners\Masters\MasterBaseListener;
use Salador\Uslugi\Listeners\Prices\PriceBaseListener;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ServiceEvent::class    => [
            ServiceBaseListener::class,
        ],
		MasterEvent::class    => [
            MasterBaseListener::class,
        ],
		PriceEvent::class    => [
            PriceBaseListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}

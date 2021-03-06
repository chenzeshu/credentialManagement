<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        'App\Events\Event' => [
//            'App\Listeners\EventListener',
//        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\UpdateLastLoginOnLogin',
        ],
        'App\Events\Submit' => [
            'App\Listeners\UpdateHistroyAndHistroyDetailsOnSubmit',
        ],
        'App\Events\CheckerChangement' => [
            'App\Listeners\ChangeMessage'
        ],
        'App\Events\CheckerDelment' => [
            'App\Listeners\DelMessage'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

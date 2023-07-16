<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'eloquent.created: App\Models\Task' => [
            'App\Listeners\TaskCreatedListener',
        ],
        'eloquent.updated: App\Models\Task' => [
            'App\Listeners\TaskUpdatedListener',
        ],
        'eloquent.deleted: App\Models\Task' => [
            'App\Listeners\TaskDeletedListener',
        ],
        'eloquent.deleted: App\Models\User' => [
            'App\Listeners\UserDeletedListener',
        ],
        'eloquent.created: App\Models\UsersTasks' => [
            'App\Listeners\UsersTasksCreatedListener',
        ],
        'eloquent.deleted: App\Models\UsersTasks' => [
            'App\Listeners\UsersTasksDeletedListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

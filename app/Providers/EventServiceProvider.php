<?php

namespace App\Providers;

use App\Models\Tenant;
use App\Models\User;
use App\Observers\TenantObserver;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;
use Bytelaunch\Nutristudents\Observers\RecipeObserver;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Bytelaunch\Nutristudents\Observers\MenuCycleDayOptionComponentObserver;
use Bytelaunch\Nutristudents\Observers\UnitOfMeasurementObserver;
use Bytelaunch\Nutristudents\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
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
        Recipe::observe(RecipeObserver::class);
        MenuCycleDayOptionComponent::observe(MenuCycleDayOptionComponentObserver::class);
        Tenant::observe(TenantObserver::class);

        UnitOfMeasurement::observe(UnitOfMeasurementObserver::class);
        User::observe(UserObserver::class);
    }
}

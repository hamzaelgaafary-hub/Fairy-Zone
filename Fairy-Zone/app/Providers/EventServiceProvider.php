<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use App\Events\OrderPlaced;
use App\Listeners\SendOrderConfirmationEmail;
use App\Listeners\DecreaseProductStock;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, array<class-string>>
     */
    protected $listen = [
        OrderPlaced::class => [
            ShouldQueue::class,
            //SendOrderConfirmationEmail::class,
            DecreaseProductStock::class,
        ],

    ];
    /**
     * 
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        // Event::listen(Login::class, MergeCartOnLogin::class);
    }


}
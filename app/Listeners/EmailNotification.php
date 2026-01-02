<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Mail\EventNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendEmailEvent $event): void
    {
        $purchase = $event->purchase;
        $attendee = $purchase->attendee;
        Mail::to($attendee->email)->send(new EventNotification($purchase));
    }
}

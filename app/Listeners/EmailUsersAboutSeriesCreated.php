<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SeriesCreated as SeriesCreatedEvent;

class EmailUsersAboutSeriesCreated implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(SeriesCreatedEvent $event)
    {
        $userList = User::all();
        foreach ($userList as $index => $user) {
           $email = new SeriesCreated(
              $event->seriesNome,
              $event->seriesId,
              $event->seriesSeasonsQty,
              $event->seriesEpisodesPerSeason
           );
           $when = now()->addSeconds($index * 2);
           Mail::to($user)->later($when, $email);
        }
    }
}

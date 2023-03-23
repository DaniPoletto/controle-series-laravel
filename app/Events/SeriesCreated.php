<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SeriesCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $seriesNome;
    public $seriesId;
    public $seriesSeasonsQty;
    public $seriesEpisodesPerSeason;
    
    public function __construct(
        $seriesNome,
        $seriesId,
        $seriesSeasonsQty,
        $seriesEpisodesPerSeason
    ) {
        $this->seriesNome = $seriesNome;
        $this->seriesId = $seriesId;
        $this->seriesSeasonsQty = $seriesSeasonsQty;
        $this->seriesEpisodesPerSeason = $seriesEpisodesPerSeason;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

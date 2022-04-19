<?php

namespace App\Observers;

use App\Models\GameHistory;
use Illuminate\Support\Str;

class GameHistoryObserver
{
    /**
     * Handle the GameHistory "creating" event.
     *
     * @param  \App\Models\GameHistory  $gameHistory
     * @return void
     */
    public function creating(GameHistory $gameHistory)
    {
        $gameHistory->uuid = Str::uuid();
        $gameHistory->duration = $gameHistory->started_at->diffInSeconds($gameHistory->ended_at) * 1000; // in milliseconds
    }

    /**
     * Handle the GameHistory "created" event.
     *
     * @param  \App\Models\GameHistory  $gameHistory
     * @return void
     */
    public function created(GameHistory $gameHistory)
    {
        //
    }

    /**
     * Handle the GameHistory "updated" event.
     *
     * @param  \App\Models\GameHistory  $gameHistory
     * @return void
     */
    public function updated(GameHistory $gameHistory)
    {
        //
    }

    /**
     * Handle the GameHistory "deleted" event.
     *
     * @param  \App\Models\GameHistory  $gameHistory
     * @return void
     */
    public function deleted(GameHistory $gameHistory)
    {
        //
    }

    /**
     * Handle the GameHistory "restored" event.
     *
     * @param  \App\Models\GameHistory  $gameHistory
     * @return void
     */
    public function restored(GameHistory $gameHistory)
    {
        //
    }

    /**
     * Handle the GameHistory "force deleted" event.
     *
     * @param  \App\Models\GameHistory  $gameHistory
     * @return void
     */
    public function forceDeleted(GameHistory $gameHistory)
    {
        //
    }
}

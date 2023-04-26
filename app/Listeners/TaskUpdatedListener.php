<?php

namespace App\Listeners;

use App\Models\History;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaskUpdatedListener
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
    public function handle($event)
    {
        $history = new History();
        $history->task_id = $event->task->id;
        $history->action = 'update';
        $history->old_value = $event->task->getOriginal();
        $history->new_value = $event->task->getChanges();
        $history->user_id = auth()->user()->id;
        $history->save();
    }
}

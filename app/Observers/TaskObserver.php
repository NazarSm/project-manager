<?php

namespace App\Observers;

use App\Mail\ChangeStatusNotification;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;

class TaskObserver
{
    /**
     * Handle the Task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        if($task->wasChanged('status')){
            Mail::to($task->project->user->email)->send(new ChangeStatusNotification($task));
        };
    }
}

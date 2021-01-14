<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $task;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $statusTitle = array_search($this->task->status, Task::STATUSES);

        return $this->from('nsmut@example.com')
            ->subject('Task status changed')
            ->view('emails.change_status')
            ->with([
                'title' => $this->task->title,
                'status' => $statusTitle,
            ]);
    }
}

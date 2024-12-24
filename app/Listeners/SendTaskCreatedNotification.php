<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class SendTaskCreatedNotification
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
    public function handle(TaskCreated $task)
    {
        Log::info("Task created :  ", ['task' => $task]);

    }
}

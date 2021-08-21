<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    public function deleted(Task $task)
    {
        $task->recordActivity('deleted_task');
    }

    public function created(Task $task)
    {
        $task->recordActivity('created_task');
    }
}

<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function interact(User $user, Task $task): bool
    {
        return $task->user_id == $user->id;
    }
}

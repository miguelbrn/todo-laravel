<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function createTask(string $taskName, string $taskDescription): Task
    {
        DB::beginTransaction();
        $task = Task::create([
            'name' => $taskName,
            'description' => $taskDescription,
            'status' => 'Em andamento',
            'user_id' => auth()->id(),
        ]);
        DB::commit();

        return $task;
    }

    public function removeTask(Task $task): void
    {
        DB::beginTransaction();
        $task->delete();
        DB::commit();
    }
}

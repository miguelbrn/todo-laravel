<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskCreate;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::query()
            ->orderBy('name')
            ->get();
        $mensagem = $request->session()->get('mensagem');
        return view('tarefas.index', compact('tasks', 'mensagem'));
    }

    public function create()
    {
        return view('tarefas.create');
    }

    public function store(
        TaskRequest $request,
        TaskService $taskService
    ) {

        $task = $taskService->createTask(
            $request->name,
            $request->description
        );

        $request->session()
            ->flash(
                'mensagem',
                "Tarefa {$task->id} criada com sucesso {$task->name}"
            );

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task, TaskService $taskService)
    {
        $taskService->removeTask($task);

        return redirect()->route('tasks.index');
    }
}

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
        if($request->has('description')) {
            $tasks = Task::where('description', 'like', '%' . $request->description . '%')->get();
        } else {
            $tasks = Task::all();
        }

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

    public function destroy(Request $request, TaskService $taskService)
    {
        $taskService->removeTask(
            Task::findOrFail($request->id)
        );

        return redirect()->route('tasks.index');
    }
}

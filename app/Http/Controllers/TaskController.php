<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskCreate;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('description') && $request->has('status')) {
            $tasks = Task::where('description', 'like', '%' . $request->description . '%')
                ->when($request->status !== null, function ($query) use ($request) {
                    return $query->where('status', $request->status);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $tasks = Task::orderBy('created_at', 'desc')->get();
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
            $request->description,
            $request->status
        );

        $request->session()
            ->flash(
                'mensagem',
                "Tarefa {$task->id} criada com sucesso: {$task->name}"
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

    public function status(Request $request)
    {
        $task = Task::findOrFail($request->id);
        $task->status = !$task->status;
        $task->save();
        return response($task);
    }
}

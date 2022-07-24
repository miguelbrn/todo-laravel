@extends('layout')

@section('cabecalho')
Lista de Tarefas
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

@auth
<a href="{{ route('tasks.create') }}" class="btn btn-dark mb-2">Adicionar</a>
@endauth

<ul class="list-group">
    @foreach($tasks as $task)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>{{ $task->name }}</span>

        <div class="input-group w-50" hidden id="input-nome-task-{{ $task->id }}">
            <input type="text" class="form-control" value="{{ $task->name }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editarTask({{ $task->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>

        <span class="d-flex">
            @auth
            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $task->id }})">
                <i class="fas fa-edit"></i>
            </button>
            @endauth
            @auth
            <form method="post" action="/tasks/{{ $task->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($task->name) }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
            @endauth
        </span>
    </li>
    @endforeach
</ul>

<script>
    function toggleInput(taskId) {
        const nomeTaskEl = document.getElementById(`nome-task-${taskId}`);
        const inputTaskEl = document.getElementById(`input-nome-task-${taskId}`);
        if (nomeTaskEl.hasAttribute('hidden')) {
            nomeTask.removeAttribute('hidden');
            inputTaskEl.hidden = true;
        } else {
            inputTaskEl.removeAttribute('hidden');
            nomeTaskEl.hidden = true;
        }
    }

    function editarTask(taskId) {
        let formData = new FormData();
        const nome = document
            .querySelector(`#input-nome-task-${taskId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('nome', nome);
        formData.append('_token', token);
        const url = `/tasks/${taskId}/editaNome`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            toggleInput(taskId);
            document.getElementById(`nome-task-${taskId}`).textContent = nome;
        });
    }
</script>
@endsection

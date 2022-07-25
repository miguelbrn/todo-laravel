@extends('layout')

@section('cabecalho')
Lista de Tarefas
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<div class="filter mb-4">
    <form action="{{ route('tasks.index') }}" method="GET">
        <div class="form-row">
            <div class="col-md-4">
                <input type="text" class="form-control" name="description" placeholder="Descrição" value="{{ $search['description'] ?? '' }}">
            </div>
            <div class="col-md-4">
                <select class="form-control" name="status" value="{{ $search['status'] ?? '' }}">
                    <option value="">Todas</option>
                    <option value="0">Em andamento</option>
                    <option value="1">Concluídas</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-dark mt-2">Filtrar</button>
        @csrf
    </form>
</div>

<div>
<a href="{{ route('tasks.create') }}" class="btn btn-dark mb-2">Adicionar</a>
<u class="list-group">
    @foreach($tasks as $task)
    <li class="list-group-item d-flex collumm justify-content-between align-items-center">
        <div class="list-group w-75">
            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $task->name }}</h5>
                <small>{{ $task->status ? 'Concluída' : 'Em andamento' }}</small>
            </div>
            <p class="mb-1">{{ $task->description }}</p>
            </a>
        </div>
        <div class="input-group w-50" hidden id="input-nome-task-{{ $task->id }}">
            <input type="text" class="form-control" value="{{ $task->name }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editarTask({{ $task->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>

        <div class="d-flex flex-column align-items-end">
            <div>
                <input class="checkbox-task" onclick="checkTask({{ $task->id }})" type="checkbox" {{ $task->status ? 'checked' : null }} value="{{ $task->status }}" style="min-width: 30px; min-height: 30px">
            </div>
            <form method="post" action="/tasks/{{ $task->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($task->name) }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
        </div>
    </li>
    @endforeach
</ul>
</div>
<script>
    function checkTask(taskId) {
        $.ajax({
            type: 'GET',
            url: '/tasks/' + taskId + '/status',
            data: {
                _token: '{{ csrf_token() }}',
                status: $('#status-checbox').is(':checked') ? 1 : 0
            },
            success: function(data) {
                window.location.reload();
            }
        });
    }
</script>
@endsection

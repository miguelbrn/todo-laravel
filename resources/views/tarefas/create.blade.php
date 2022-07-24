@extends('layout')

@section('cabecalho')
    Adicionar nova Tarefa
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])

<form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col col-8">
            <label for="name">Nome da tarefa</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>

    </div>
    <div class="row">
        <div class="col col-12">
            <label for="description">Descricão</label>
            <input type="text" class="form-control" name="description" id="description">
        </div>
    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>
</form>
@endsection

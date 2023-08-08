@extends('templates.painel-adm')
@section('title', 'Editar Clientes')
@section('content')
<h6 class="mb-4"><i>EDIÇÃO DE CLIENTES</i></h6><hr>
<form method="POST" action="{{route('clientes.editar', $item)}}">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input value="{{$item->nome}}" type="text" class="form-control" id="nome" name="nome" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input value="{{$item->cpf}}" type="text" class="form-control" id="cpf" name="cpf">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input value="{{$item->telefone}}" type="text" class="form-control" id="telefone" name="telefone">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="telefone2">Telefone 2</label>
                <input value="{{$item->telefone2}}" type="text" class="form-control" id="telefone2" name="telefone2">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="bairro">Email</label>
                <input value="{{$item->email}}" type="text" class="form-control" id="bairro" name="bairro">
            </div>
        </div>
    </div>
    <input value="{{$item->edificio}}" type="hidden" name="oldedificio">
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</form>
@endsection
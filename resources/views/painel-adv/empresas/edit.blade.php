@extends('templates.painel-adm')
@section('title', 'Editar Inquilinos')
@section('content')
<h6 class="mb-4"><i>EDIÇÃO DE EMPRESAS</i></h6><hr>
<form method="POST" action="{{route('empresas.editar', $item)}}">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="edificio">Nome</label>
                <input value="{{$item->nome}}" type="text" class="form-control" id="edificio" name="edificio" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="matricula">CNPJ</label>
                <input value="{{$item->cnpj}}" type="text" class="form-control" id="matricula" name="matricula">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="endereco">Telefone</label>
                <input value="{{$item->telefone}}" type="text" class="form-control" id="endereco" name="endereco">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="numero">Telefone 2</label>
                <input value="{{$item->telefone2}}" type="text" class="form-control" id="numero" name="numero">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="bairro">Email</label>
                <input value="{{$item->email}}" type="text" class="form-control" id="bairro" name="bairro">
            </div>
        </div>
    </div>
    <input value="{{$item->nome}}" type="hidden" name="oldedificio">
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</form>
@endsection
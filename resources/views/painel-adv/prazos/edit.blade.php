@extends('templates.painel-adm')
@section('title', 'Editar Inquilinos')
@section('content')
<h6 class="mb-4"><i>EDIÇÃO DE INQUILINOS</i></h6><hr>
<form method="POST" action="{{route('imoveis.editar', $item)}}">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="edificio">Nome</label>
                <input value="{{$item->edificio}}" type="text" class="form-control" id="edificio" name="edificio" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="matricula">Matrícula</label>
                <input value="{{$item->matricula}}" type="text" class="form-control" id="matricula" name="matricula">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input value="{{$item->endereco}}" type="text" class="form-control" id="endereco" name="endereco">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="numero">Número</label>
                <input value="{{$item->numero}}" type="text" class="form-control" id="numero" name="numero">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input value="{{$item->bairro}}" type="text" class="form-control" id="bairro" name="bairro">
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
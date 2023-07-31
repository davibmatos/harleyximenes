@extends('templates.painel-adm')
@section('title', 'Editar Contratos')
@section('content')
    <h6 class="mb-4"><i>EDIÇÃO DE CONTRATOS</i></h6>
    <hr>
    <form method="POST" action="{{route('contratos.editar', $item)}}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">CPF</label>
                    <input value="{{$item->inquilino->cpf}}" type="text" class="form-control" id="cpf" name="cpf" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input value="{{$item->inquilino->nome}}" type="text" class="form-control" id="nome" name="nome" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Edifício</label>
                    <input value="{{$item->apartamento->edificio}}" type="text" class="form-control" id="edificio" name="edificio" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Telefone</label>
                    <input value="{{$item->inquilino->telefone}}" type="text" class="form-control" id="telefone" name="telefone" disabled>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Data do vencimento</label>
                    <input value="{{$item->vencimento}}" type="date" class="form-control" id="vencimento" name="vencimento">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="data_inicio">Data de início</label>
                    <input value="{{$item->data_inicio}}" type="date" class="form-control" id="data_inicio" name="data_inicio">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="data_fim">Data de fim</label>
                    <input value="{{$item->data_fim}}" type="date" class="form-control" id="data_fim" name="data_fim">
                </div>
            </div>
        </div>

        <p align="left">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </p>
    </form>
@endsection
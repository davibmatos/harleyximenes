@extends('templates.painel-adm')
@section('title', 'Inserir Inquilinos')
@section('content')
<h6 class="mb-4"><i>CADASTRO DE APARTAMENTOS</i></h6><hr>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<form method="POST" action="{{route('apartamentos.insert')}}">
    @csrf

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="imovel_id">Nome do imóvel</label>
                <select class="form-control" id="imovel_id" name="imovel_id" required>
                    <option value="">Selecione um imóvel</option>
                    @foreach($imoveis as $imovel)
                        <option value="{{ $imovel->id }}">{{ $imovel->edificio }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="valor">Valor R$</label>
                <input type="text" class="form-control money" id="valor" name="valor">
            </div>
        </div>
    </div>

       

    <div class="row">
        <div class="col-md-12">
            <p align="left">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </p>
        </div>
    </div>
</form>
@endsection
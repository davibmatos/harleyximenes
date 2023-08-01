@extends('templates.painel-adm')
@section('title', 'Inserir Prazos')
@section('content')
    <h6 class="mb-4"><i>CADASTRO DE PRAZOS</i></h6>
    <hr>
    <form method="POST" action="{{ route('prazos.insert') }}">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="edificio" name="edificio" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="matricula">Matrícula</label>
                    <input type="text" class="form-control" id="matricula" name="matricula" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro">
                </div>
            </div>
        </div>
        <div id="apartamentos">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="numero">Número do Apto</label>
                        <input type="text" class="form-control" id="numero" name="apartamentos[0][numero]">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="valor">Valor R$</label>
                        <input type="text" class="form-control money" id="valor" name="apartamentos[0][valor]">
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" id="adicionarApartamento">Adicionar Apartamento</button>

        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
@endsection

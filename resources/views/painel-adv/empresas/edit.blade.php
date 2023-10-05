@extends('templates.painel-adm')
@section('title', 'Editar Parte Adversa')
@section('content')
    <h6 class="mb-4"><i>EDIÇÃO DE PARTE ADVERSA</i></h6>
    <hr>
    <form method="POST" action="{{ route('empresas.editar', $item) }}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="edificio">Nome</label>
                    <input value="{{ $item->nome }}" type="text" class="form-control" id="nome" name="nome"
                        required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="matricula">CNPJ</label>
                    <input value="{{ $item->cnpj }}" type="text" class="form-control" id="cnpj" name="cnpj">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endereco">Telefone</label>
                    <input value="{{ $item->telefone }}" type="text" class="form-control" id="telefone" name="telefone">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="numero">Telefone 2</label>
                    <input value="{{ $item->telefone2 }}" type="text" class="form-control" id="telefone2" name="telefone2">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="bairro">Email</label>
                    <input value="{{ $item->email }}" type="text" class="form-control" id="email" name="email">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endereco">Responsável</label>
                    <input type="text" class="form-control" id="preposto" name="preposto"
                        value="{{ $item->preposto ?? '' }}"> <!-- Substitua pelo nome correto da variável -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco"
                        value="{{ $item->endereco ?? '' }}"> <!-- Substitua pelo nome correto da variável -->
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
    <script src="{{ asset('js/mascaras.js') }}" defer></script>
    <script>
        $(document).ready(function() {
            aplicarMascaras();
        });
    </script>
@endsection


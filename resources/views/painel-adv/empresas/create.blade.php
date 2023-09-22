@extends('templates.painel-adm')
@section('title', 'Inserir Parte Adversa')
@section('content')
    <h6 class="mb-4"><i>CADASTRO DE PARTE ADVERSA</i></h6>
    <hr>
    <form method="POST" action="{{ route('empresas.insert') }}">
        @csrf

        <div class="row">            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="matricula">CNPJ/CPF</label>
                    <input type="text" class="form-control" id="campoCpfCnpj" name="cnpj" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
            </div>           
            <div class="col-md-2">
                <div class="form-group">
                    <label for="matricula">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                </div>
            </div>            
        </div>
        <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="endereco">Responsável</label>
                <input type="text" class="form-control" id="preposto" name="preposto">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="matricula">Telefone Responsável</label>
                <input type="text" class="form-control" id="telefone2" name="telefone2" required>
            </div>
        </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endereco">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco">
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

@extends('templates.painel-adm')
@section('title', 'Inserir Inquilinos')
@section('content')
    <h6 class="mb-4"><i>CADASTRO DE EMPRESAS</i></h6>
    <hr>
    <form method="POST" action="{{ route('empresas.insert') }}">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="edificio" name="nome" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="matricula">CNPJ</label>
                    <input type="text" class="form-control" id="cnpj" name="cnpj" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="matricula">Telefone</label>
                    <input type="text" class="form-control" id="cnpj" name="cnpj" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="matricula">Telefone 2</label>
                    <input type="text" class="form-control" id="cnpj" name="cnpj" required>
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
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>

<script>
@endsection

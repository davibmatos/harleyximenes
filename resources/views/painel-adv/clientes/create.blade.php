@extends('templates.painel-adm')
@section('title', 'Inserir Clientes')
@section('content')

    <div class="container">
        <h6 class="mb-4"><i>CADASTRO DE CLIENTES</i></h6>
        <hr>
        <form method="POST" action="{{ route('clientes.insert') }}">
            @csrf

            <!-- Inquilino fields -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cpf">CPF/CNPJ</label>
                        <input type="text" class="form-control" id="campoCpfCnpj" name="cpf">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefone">Telefone2</label>
                        <input type="text" class="form-control" id="telefone2" name="telefone2">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="funcao">Profissão</label>
                        <input type="text" class="form-control" id="funcao" name="funcao">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="salario">Salário</label>
                        <input type="text" class="form-control" id="salario" name="salario">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="empresa">Estado Civil</label>
                        <input type="text" class="form-control" id="ecivil" name="ecivil">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nomeEmpresa">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco">
                    </div>
                </div>
            </div>
            {{-- <button type="button" class="btn btn-primary add-cnpj">+</button><br><br> --}}
            

            <div class="row">
                <div class="col-md-12 text-right">
                    <p align="left">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </p>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="{{ asset('js/contratos.js') }}" defer></script>
    <script src="{{ asset('js/mascaras.js') }}" defer></script>
    <script src="{{ asset('js/empresas.js') }}" defer></script>
    <script>
        $(document).ready(function() {
            aplicarMascaras();
        });
    </script>
@endsection

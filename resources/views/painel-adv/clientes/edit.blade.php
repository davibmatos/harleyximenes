@extends('templates.painel-adm')
@section('title', 'Editar Clientes')
@section('content')

    <div class="container">
        <h6 class="mb-4"><i>EDIÇÃO DE CLIENTES</i></h6>
        <hr>
        <form method="POST" action="{{ route('clientes.editar', $item) }}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input value="{{ $item->nome }}" type="text" class="form-control" id="nome" name="nome"
                            required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="{{ $item->email }}" type="email" class="form-control" id="email"
                            name="email">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cpf">CPF/CNPJ</label>
                        <input value="{{ $item->cpf }}" type="text" class="form-control" id="campoCpfCnpj"
                            name="cpf">
                    </div>
                </div>
            </div>

            <!-- Outros campos faltantes -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="funcao">Profissão</label>
                        <input value="{{ $item->funcao }}" type="text" class="form-control" id="funcao"
                            name="funcao">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="salario">Salário</label>
                        <input value="{{ $item->salario }}" type="text" class="form-control" id="salario"
                            name="salario">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ecivil">Estado Civil</label>
                        <input value="{{ $item->ecivil }}" type="text" class="form-control" id="ecivil"
                            name="ecivil">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input value="{{ $item->endereco }}" type="text" class="form-control" id="endereco"
                            name="endereco">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="endereco">Telefone</label>
                        <input value="{{ $item->telefone }}" type="text" class="form-control" id="telefone"
                            name="telefone">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="endereco">Telefone 2</label>
                        <input value="{{ $item->telefone2 }}" type="text" class="form-control" id="telefone2"
                            name="telefone2">
                    </div>
                </div>
            </div>           
            <div class="row">
                <div class="col-md-12 text-right">
                    <p align="left">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </p>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Código jQuery
        $(document).ready(function() {
            $('#documentos').on('change', function() {
                Array.from(this.files).forEach(file => {
                    let caixa = $('<div class="documento-caixa"></div>');
                    caixa.append(`<span>${file.name}</span>`);
                    caixa.append(
                        '<input type="text" placeholder="Nome amigável para o arquivo" name="nomes_amigaveis[]">'
                    );
                    $('#lista-documentos').append(caixa);
                });
            });
        });
    </script>
@endsection

@extends('templates.painel-adm')
@section('title', 'Inserir Clientes')
@section('content')

    <div class="container">
        <h6 class="mb-4"><i>CADASTRO DE CLIENTES</i></h6>
        <hr>
        <form method="POST" action="{{ route('clientes.insert') }}" enctype="multipart/form-data">
            @csrf

         
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
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="documentos">Documentos (PDF, máximo 2.0 MB)</label>
                        <input type="file" class="form-control-file" id="documentos" name="documentos[]" accept=".pdf"
                            multiple>
                    </div>
                </div>
            </div>

            <!-- Seção para listar documentos anexados -->
            <div class="row">
                <div class="col-md-12">
                    <h5>Documentos Anexados:</h5>
                    <div id="lista-documentos">
                        <!-- Os documentos anexados serão listados aqui -->
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
            let listaDocumentos = $('#lista-documentos');
            let arquivosAnexados = [];

            $('#documentos').on('change', function() {
                Array.from(this.files).forEach(file => {
                    arquivosAnexados.push(file);
                });
                atualizarListaDocumentos();
            });

            function atualizarListaDocumentos() {
                listaDocumentos.empty();
                arquivosAnexados.forEach((file, index) => {
                    let caixa = $('<div class="documento-caixa"></div>');
                    caixa.append(`<span>${file.name}</span>`);
                    let botaoRemover = $(
                        '<button type="button" class="btn btn-danger btn-sm">Remover</button>');
                    botaoRemover.on('click', function() {
                        arquivosAnexados.splice(index, 1);
                        atualizarListaDocumentos();
                    });
                    caixa.append(botaoRemover);
                    listaDocumentos.append(caixa);
                });
            }
        });
    </script>
    <style>
        .documento-caixa {
            padding: 10px;
            border: 1px solid #ccc;
            margin-top: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 50%;
        }

        button[type="submit"] {
            margin-top: 20px;
            /* Ajuste o valor conforme necessário */
        }
    </style>
@endsection

@extends('templates.painel-adm')
@section('title', 'Inserir Inquilinos e Contratos')
@section('content')

    <div class="container">
        <h6 class="mb-4"><i>CADASTRO DE INQUILINOS E CONTRATOS</i></h6>
        <hr>
        <form method="POST" action="{{ route('inquilinos.insert') }}">
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
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rg">RG</label>
                        <input type="text" class="form-control" id="rg" name="rg">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefone2">Telefone Opcional</label>
                        <input type="text" class="form-control" id="telefone2" name="telefone2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="observacoes">Observações</label>
                        <textarea class="form-control" id="observacoes" name="observacoes" rows="4"></textarea>
                    </div>
                </div>
            </div>

            <!-- Contrato fields -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="edificio">Edifício</label>
                        <select class="form-control" id="edificio" name="edificio" required>
                            <option value="" selected disabled>Selecione um edifício</option>
                            @foreach ($edificios as $edificio)
                                <option value="{{ $edificio->edificio }}">{{ $edificio->edificio }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="apartamento">Apartamento</label>
                        <select class="form-control" id="apartamento" name="apartamento_id" disabled>
                            <option value="" selected disabled>Selecione um apartamento</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="text" class="form-control" id="valor" name="valor" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="vencimento">Dia do Vencimento</label>
                        <input type="number" class="form-control" id="vencimento" name="vencimento" min="1"
                            max="31">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="data_inicio">Início do Contrato</label>
                        <input type="date" class="form-control" id="data_inicio" name="data_inicio">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="data_fim">Fim do Contrato</label>
                        <input type="date" class="form-control" id="data_fim" name="data_fim">
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
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="{{ asset('js/contratos.js') }}" defer></script>
    <script src="{{ asset('js/mascaras.js') }}" defer></script>
    <script>
        $(document).ready(function () {
            aplicarMascaras();
        });
    </script>
@endsection
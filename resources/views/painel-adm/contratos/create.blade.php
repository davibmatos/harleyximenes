@extends('templates.painel-adm')
@section('title', 'Inserir Contratos')
@section('content')

    <h6 class="mb-4"><i>CADASTRO DE CONTRATOS</i></h6>
    <hr>
    <form method="POST" action="{{ route('contratos.insert') }}">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                    <input type="hidden" id="inquilino_id" name="inquilino_id">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" readonly>
                </div>
            </div>
        </div>
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
            <div class="col-md-2">
                <div class="form-group">
                    <label for="apartamento">Apartamento</label>
                    <select class="form-control" id="apartamento" name="apartamento_id" disabled>
                        <option value="" selected disabled>Selecione um apartamento</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor" disabled>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="vencimento">Dia do Vencimento</label>
                    <input type="number" class="form-control" id="vencimento" name="vencimento" min="1"
                        max="31" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="data_inicio">Data do Início do Contrato</label>
                    <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="data_fim">Data do Fim do Contrato</label>
                    <input type="date" class="form-control" id="data_fim" name="data_fim" required>
                </div>
            </div>
        </div>

        <p align="left">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </p>

    </form>
    <script>
        window.inquilinosPorCpfUrl = "{{ url('/inquilinos/por-cpf') }}";
    </script>

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

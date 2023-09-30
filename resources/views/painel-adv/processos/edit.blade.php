@extends('templates.painel-adm')
@section('title', 'Editar Processo')
@section('content')
    <h6 class="mb-4"><i>EDIÇÃO DE PROCESSOS</i></h6>
    <hr>
    <form method="POST" action="{{ route('processos.editar', $item) }}">
        @csrf
        @method('put')

        <!-- Busca de cliente e empresa -->
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="busca_cliente">Buscar Autor pelo CPF/CNPJ</label>
                    <input type="text" class="form-control" id="busca_cliente" placeholder="Digite o CPF/CNPJ"
                        value="{{ old('busca_cliente') }}">
                    <button type="button" id="btn_buscar_cliente" class="btn btn-secondary mt-2">Buscar</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="busca_empresa">Buscar Empresa pelo CPF/CNPJ</label>
                    <input type="text" class="form-control" id="busca_empresa" placeholder="Digite o CPF/CNPJ"
                        value="{{ old('busca_empresa') }}">
                    <button type="button" id="btn_buscar_empresa" class="btn btn-secondary mt-2">Buscar</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nome_autor">Parte autora</label>
                    <input type="text" class="form-control" id="nome_autor" name="nome_cliente" required
                        value="{{ $item->cliente->nome }}">
                    <input type="hidden" id="clienteIdHidden" name="cliente_id" value="{{ $item->cliente->id }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nome_re">Parte ré</label>
                    <input type="text" class="form-control" id="nome_re" name="nome_empresa" required
                        value="{{ $item->empresa->nome }}">
                    <input type="hidden" id="empresaIdHidden" name="empresa_id" value="{{ $item->empresa->id }}">
                </div>
            </div>
        </div>

        <!-- Número do Processo, Comarca e Vara -->
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="numero">Número do Processo</label>
                    <input type="text" class="form-control" id="numero" name="numero" required
                        value="{{ $item->numero }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="comarca">Comarca</label>
                    <select class="form-control" id="comarca" name="comarca_id">
                        <option value="" selected>Selecione uma Comarca</option>
                        @foreach ($comarcas as $comarca)
                            <option value="{{ $comarca->id }}" {{ $item->comarca_id == $comarca->id ? 'selected' : '' }}>
                                {{ $comarca->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="vara">Vara</label>
                    <select class="form-control" id="vara" name="vara_id">
                        <option value="" selected>Selecione uma Vara</option>
                        @foreach ($varas as $vara)
                            <option value="{{ $vara->id }}" {{ $item->vara_id == $vara->id ? 'selected' : '' }}>
                                {{ $vara->numero }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="data_aud">Data Audiência</label>
                    <input value="{{ $item->data_aud }}" type="date" class="form-control" id="data_aud" name="data_aud"
                        required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nome_autor">Horário</label>
                    <input value="{{ $item->hora_aud }}" type="time" class="form-control" id="hora_aud" name="hora_aud"
                        required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nome_re">Tipo da audiência</label>
                    <input value="{{ $item->tipo_aud }}" type="text" class="form-control" id="tipo_aud" name="tipo_aud"
                        required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="advogado">Advogado Responsável</label>
                    <select class="form-control" id="advogado" name="adv_ids[]" multiple>
                        @foreach ($advogados as $advogado)
                            <option value="{{ $advogado->id }}"
                                {{ in_array($advogado->id, $item->advogados->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $advogado->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- Início dos novos campos -->
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="movimentacao">Movimentação</label>
                    <textarea class="form-control" id="movimentacao" name="movimentacao" rows="4">{{ $item->movimentacao }}</textarea>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-3">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="acordo" name="acordo"
                        {{ $item->acordo ? 'checked' : '' }}>
                    <label class="form-check-label" for="acordo">Acordo?</label>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="valor_total">Valor Total</label>
                    <input type="text" class="form-control" id="valor_total" name="valor_total"
                        value="{{ $item->valor_total }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="qtd_parcelas">Quantidade de Parcelas</label>
                    <input type="number" class="form-control" id="qtd_parcelas" name="qtd_parcelas"
                        value="{{ $item->qtd_parcelas }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vencimentos">Vencimentos (dd/mm/aaaa separados por vírgula)</label>
                    <input type="text" class="form-control" id="vencimentos" name="vencimentos"
                        value="{{ $item->vencimentos }}">
                </div>
            </div>
        </div>
        <!-- Fim dos novos campos -->
        <input value="{{ $item->processo }}" type="hidden" name="oldprocesso">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
    <script src="{{ asset('js/mascaras.js') }}"></script>
    <script src="{{ asset('js/processos.js') }}"></script>
    <script src="{{ asset('js/processos_ajax.js') }}"></script>
    <script>
        $(document).ready(function() {
            aplicarMascaras();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#advogado').select2();
        });
    </script>
@endsection

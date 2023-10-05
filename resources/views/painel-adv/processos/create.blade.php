        @extends('templates.painel-adm')
        @section('title', 'Cadastro de Processos')
        @section('content')
            <h6 class="mb-4"><i>CADASTRO DE PROCESSOS</i></h6>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <hr>
            <form method="POST" action="{{ route('processos.insert') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="usuario_id" value="{{ Session::get('id_usuario') }}">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="busca_cliente">Buscar Autor</label>
                            <input type="text" class="form-control" id="busca_cliente" placeholder="Digite o CPF/CNPJ">
                            <button type="button" id="btn_buscar_cliente" class="btn btn-secondary mt-2">Buscar</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="busca_empresa">Buscar parte Adversa</label>
                            <input type="text" class="form-control" id="busca_empresa" placeholder="Digite o CPF/CNPJ">
                            <button type="button" id="btn_buscar_empresa" class="btn btn-secondary mt-2">Buscar</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome_autor">Parte autora</label>
                            <input type="text" class="form-control" id="nome_autor" name="nome_cliente" required disabled>
                            <input type="hidden" id="clienteIdHidden" name="cliente_id">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome_re">Parte Adversa</label>
                            <input type="text" class="form-control" id="nome_re" name="nome_empresa" required disabled>
                            <input type="hidden" id="empresaIdHidden" name="empresa_id">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="numero">Número do Processo</label>
                            <input type="text" class="form-control" id="numero" name="numero" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="comarca">Comarca</label>
                            <select class="form-control" id="comarca" name="comarca_id">
                                <option value="" selected>Selecione uma Comarca</option>
                                @foreach ($comarcas as $comarca)
                                    <option value="{{ $comarca->id }}">{{ $comarca->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="vara">Vara</label>
                            <select class="form-control" id="vara" name="vara_id">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="advogado">Adv Responsável</label>
                            <select class="form-control" id="advogado" name="adv_ids[]" multiple>
                                @foreach ($advogados as $advogado)
                                    <option value="{{ $advogado->id }}">{{ $advogado->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="numero">Data da audiência</label>
                            <input type="date" class="form-control" id="data_aud" name="data_aud">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="hora_aud">Hora da audiência</label>
                            <input type="time" class="form-control" id="hora_aud" name="hora_aud">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="hora_aud">Tipo de audiência</label>
                            <input type="text" class="form-control" id="tipo_aud" name="tipo_aud">
                        </div>
                    </div>
                </div>

                <!-- Início dos novos campos -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="movimentacao">Movimentação</label>
                            <textarea class="form-control" id="movimentacao" name="movimentacao" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-md-3">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="acordo" name="acordo">
                            <label class="form-check-label" for="acordo">Acordo?</label>
                        </div>
                    </div>
                </div>

                <div id="campos-acordo" style="display: none;">
                    <div class="row mt-1">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="valor_total">Valor Total</label>
                                <input type="text" class="form-control" id="valor_total" name="valor_total">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qtd_parcelas">Quantidade de Parcelas</label>
                                <input type="number" class="form-control" id="qtd_parcelas" name="qtd_parcelas">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vencimentos">Vencimentos (dd/mm/aaaa separados por vírgula)</label>
                                <input type="text" class="form-control" id="vencimentos" name="vencimentos">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fim dos novos campos -->

                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
            <script src="{{ asset('js/mascaras.js') }}"></script>
            <script src="{{ asset('js/processos.js') }}"></script>
            <script src="{{ asset('js/processos_ajax.js') }}"></script>
            <script src="{{ asset('js/buscaadvogados.js') }}"></script>
            <script>
                $(document).ready(function() {
                    aplicarMascaras();
                });
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#advogado').select2();
                    $('#valor_total').mask('000.000.000.000.000,00', {reverse: true});
                });
            </script>
            <script>
                $(document).ready(function() {
    // Ouvinte para mudanças no checkbox de acordo
    $('#acordo').change(function() {
        if (this.checked) {
            // Mostra os campos de acordo se o checkbox está marcado
            $('#campos-acordo').show();
        } else {
            // Esconde os campos de acordo se o checkbox não está marcado
            $('#campos-acordo').hide();
        }
    });
});
</script>
            

        @endsection

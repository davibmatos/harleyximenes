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
                            <input type="text" class="form-control" id="nome_autor" name="nome_cliente" required>
                            <input type="hidden" id="clienteIdHidden" name="cliente_id">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome_re">Parte ré</label>
                            <input type="text" class="form-control" id="nome_re" name="nome_empresa" required>
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="anexo">Anexo (PDF)</label>
                            <input type="file" class="form-control-file" id="anexo" name="anexos[]" accept=".pdf"
                                multiple>
                        </div>
                    </div>
                </div>

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
                });
            </script>

        @endsection

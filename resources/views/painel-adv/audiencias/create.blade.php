@extends('templates.painel-adm')
@section('title', 'Cadastro de audiências')
@section('content')
    <h6 class="mb-4"><i>CADASTRO DE AUDIÊNCIAS</i></h6>
    <hr>
    <form method="POST" action="{{ route('audiencias.insert') }}">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="numero">Número do Processo</label>
                    <input type="text" class="form-control" id="numero" name="numero" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cliente">Cliente</label>
                    <input type="text" class="form-control" id="cliente" name="cliente" required readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="data_aud">Data Audiência</label>
                    <input value="{{ old('data_aud') }}" type="date" class="form-control" id="data_aud" name="data_aud" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="hora_aud">Hora Audiência</label>
                    <input value="{{ old('hora_aud') }}" type="time" class="form-control" id="hora_aud" name="hora_aud" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tipo_aud">Tipo de Audiência</label>
                    <input value="{{ old('tipo_aud') }}" type="text" class="form-control" id="tipo_aud" name="tipo_aud" required>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#numero').on('blur', function() {
                var numeroProcesso = $(this).val();
                $.ajax({
                    url: '{{ route('processos.getCliente') }}',
                    type: 'get',
                    data: {
                        numero_processo: numeroProcesso
                    },
                    success: function(response) {
                        $('#cliente').val(response.nome);
                    },
                    error: function() {
                        $('#cliente').val('');
                    }
                });
            });
        });
    </script>
@endsection

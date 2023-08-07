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
                    <label for="nome">Número do Processo</label>
                    <input type="text" class="form-control" id="processo_id" name="processo_id" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="matricula">Cliente</label>
                    <input type="text" class="form-control" id="cliente" name="cliente" required readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="endereco">Data Audiência</label>
                    <input type="text" class="form-control" id="data_aud" name="data_aud">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="numero">Hora Audiência</label>
                    <input type="text" class="form-control" id="hora_aud" name="hora_aud">
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
        var getClienteUrl = "{{ route('audiencias.getCliente') }}";
    </script>
    <script src="{{ asset('js/buscarclientes.js') }}" defer></script>
@endsection

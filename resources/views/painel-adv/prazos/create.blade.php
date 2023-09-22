@extends('templates.painel-adm')
@section('title', 'Inserir Prazos')
@section('content')
    <h6 class="mb-4"><i>CADASTRO DE PRAZOS</i></h6>
    <hr>
    <form method="POST" action="{{ route('prazos.insert') }}">
        @csrf
        <input type="hidden" name="usuario_id" value="{{ Session::get('id_usuario') }}">

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nome">Processo</label>
                    <input type="text" class="form-control" id="numero" name="numero" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="matricula">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="4"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="endereco">Data do Início</label>
                    <input type="text" class="form-control" id="data_ini" name="data_ini">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="numero">Prazo Fatal</label>
                    <input type="text" class="form-control" id="data_fim" name="data_fim">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
    <script src="{{ asset('js/processos.js') }}"></script>
    <script src="{{ asset('js/mascaras.js') }}"></script>
    <script src="{{ asset('js/processos_ajax.js') }}"></script>
@endsection

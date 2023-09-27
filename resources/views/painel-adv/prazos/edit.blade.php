@extends('templates.painel-adm')
@section('title', 'Editar Prazos')
@section('content')
    <h6 class="mb-4"><i>EDIÇÃO DE PRAZOS</i></h6>
    <hr>
    <form method="POST" action="{{ route('prazos.editar', $item) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="usuario_id" value="{{ Session::get('id_usuario') }}">

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nome">Processo</label>
                    <input type="text" class="form-control" id="numero" name="numero"
                        value="{{ $item->processo->numero ?? '' }}" disabled>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="matricula">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="4">{{ $item->descricao }}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="endereco">Data do Início</label>
                    <input type="text" class="form-control" id="data_ini" name="data_ini" value="{{ $item->data_ini }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="numero">Prazo Fatal</label>
                    <input type="text" class="form-control" id="data_fim" name="data_fim" value="{{ $item->data_fim }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="em aberto" {{ $item->status === 'em aberto' ? 'selected' : '' }}>Em aberto</option>
                        <option value="Cumprido" {{ $item->status === 'Cumprido' ? 'selected' : '' }}>Cumprido</option>
                        <option value="vencido" {{ $item->status === 'vencido' ? 'selected' : '' }}>Vencido</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </div>
    </form>
    <script src="{{ asset('js/processos.js') }}"></script>
    <script src="{{ asset('js/mascaras.js') }}"></script>
    <script src="{{ asset('js/processos_ajax.js') }}"></script>
@endsection

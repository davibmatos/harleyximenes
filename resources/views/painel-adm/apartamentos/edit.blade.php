@extends('templates.painel-adm')
@section('title', 'Editar Apartamentos')
@section('content')
    <h6 class="mb-4"><i>EDIÇÃO DE APARTAMENTOS</i></h6>
    <hr>
    <form method="POST" action="{{ route('apartamentos.editar', $item) }}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nome">Número</label>
                    <input value="{{ $item->numero }}" type="text" class="form-control" id="numero" name="numero"
                        required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="imovel_id">Nome do imóvel</label>
                    <select class="form-control" id="imovel_id" name="imovel_id" required>
                        <option value="">Selecione um imóvel</option>
                        @foreach ($imoveis as $imovel)
                            <option value="{{ $imovel->id }}" {{ $item->imovel_id == $imovel->id ? 'selected' : '' }}>{{ $imovel->edificio }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor">Valor R$</label>
                    <input value="{{ $item->valor }}" type="text" class="form-control" id="valor" name="valor"
                        required>
                </div>
            </div>
        </div>

        <input value="{{ $item->nome }}" type="hidden" name="oldnome">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
@endsection

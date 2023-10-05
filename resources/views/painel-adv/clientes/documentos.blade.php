@extends('templates.painel-adm')
@section('title', 'Documentos do Cliente')
@section('content')

    <div class="container">
        <h6 class="mb-4"><i>DOCUMENTOS DO CLIENTE: {{ $item->nome }}</i></h6>
        <hr>

        <a href="{{ route('clientes.index', $item) }}" class="btn btn-secondary mb-4">Voltar para Clientes</a>

        <form method="POST" action="{{ route('documentosCliente.adicionar', ['cliente' => $item->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nome_documento">Nome do Documento</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="nome_documento" name="nome_documento"
                        placeholder="Insira o nome do documento">
                </div>
            </div>
            <div class="form-group">
                <label for="documentos">Adicionar Documentos (PDF, máximo 2.0 MB)</label>
                <input type="file" class="form-control-file" id="documentos" name="documentos[]" accept=".pdf" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Documentos</button>
        </form>

        <h5 class="mt-4">Documentos Anexados:</h5>
        <div id="lista-documentos">
            @foreach ($item->documentos as $documento)
                <div class="documento-caixa">
                    <span>{{ $documento->nome_documento ?? basename($documento->nome_arquivo) }}</span>
                    <!-- Exibe o nome do documento se existir -->
                    <form
                        action="{{ route('documentosCliente.deletar', ['cliente' => $item->id, 'documento' => $documento->id]) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                        <a href="{{ route('documentos.download', ['cliente' => $item->id, 'documento' => $documento->id]) }}"
                            class="btn btn-success btn-sm">Download</a>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

@endsection

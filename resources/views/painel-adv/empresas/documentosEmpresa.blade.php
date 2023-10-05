@extends('templates.painel-adm')
@section('title', 'Documentos da Parte adversa')
@section('content')

    <div class="container">
        <h6 class="mb-4"><i>DOCUMENTOS DA PARTE ADVERSA: {{ $item->nome }}</i></h6>
        <hr>

        <a href="{{ route('empresas.index', $item) }}" class="btn btn-secondary mb-4">Voltar para Empresa</a>

        <form action="{{ route('documentosEmpresa.adicionar', ['empresa' => $item->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div id="nome-documento-container">
                <!-- Os campos de nome do documento serão inseridos aqui -->
            </div>

            <div class="form-group">
                <label for="documentos">Adicionar Documentos (PDF, máximo 2.0 MB)</label>
                <input type="file" class="form-control-file" id="documentos" name="documentos[]" accept=".pdf" multiple
                    onchange="addNomeDocumentoFields()">
            </div>

            <button type="submit" class="btn btn-primary">Adicionar Documentos</button>
        </form>

        <!-- Lista de Documentos -->
        @if ($item->documentoEmpresas)
            <ul class="list-group mt-4">
                @foreach ($item->documentoEmpresas as $documento)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <span class="badge badge-primary badge-pill">{{ $documento->nome_documento }}</span>
                        </div>
                        <div class="d-flex">
                            <!-- Botão para Download -->
                            <a href="{{ route('documentosEmpresa.download', ['empresa' => $item->id, 'documento' => $documento->id]) }}"
                                class="btn btn-success btn-sm">Download</a>

                            <!-- Botão para Deletar -->
                            <form
                                action="{{ route('documentosEmpresa.deletar', ['empresa' => $item->id, 'documento' => $documento->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ml-2">Deletar</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <script>
        function addNomeDocumentoFields() {
            const container = document.getElementById('nome-documento-container');
            const files = document.getElementById('documentos').files;

            // Limpar campos existentes
            container.innerHTML = "";

            for (let i = 0; i < files.length; i++) {
                const field = document.createElement('input');
                field.type = 'text';
                field.name = 'nome_documento[]';
                field.placeholder = `Nome para o documento ${i + 1}`;
                field.className = 'form-control mt-2'; // Adicione classes para estilização

                container.appendChild(field);
            }
        }
    </script>

@endsection

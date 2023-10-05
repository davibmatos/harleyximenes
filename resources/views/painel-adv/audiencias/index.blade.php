@extends('templates.painel-adm')
@section('title', 'Audiências')
@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    
    $nivel_usuario = Session::get('nivel_usuario');
    
    if ($nivel_usuario !== 'admin' && $nivel_usuario !== 'adv') {
        echo "<script language='javascript'> window.location='./' </script>";
    }
    
    if (!isset($id)) {
        $id = '';
    }
    ?>

    <div class="d-flex justify-content-end">
        <form method="GET" action="{{ url()->current() }}" class="form-inline">
            <div class="form-group">
                <label for="data_inicio" class="mr-2">Data Inicial</label>
                <input type="text" style="width: 150px;" class="form-control mr-2" id="data_ini" name="data_ini">
            </div>
            <div class="form-group">
                <label for="data_fim" class="mr-2">Data Final</label>
                <input type="text" style="width: 150px;" class="form-control mr-2" id="data_fim" name="data_fim">
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
    </div>
    <br>

    {{-- <a href="{{ route('audiencias.inserir') }}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir Audiência</a> --}}

    @if (session('error'))
        <div class="alert alert-danger mt-2">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Processo</th>
                            <th>Parte autora</th>
                            <th>Parte ré</th>
                            <th>Vara</th>
                            <th>Comarca</th>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Responsáveis</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itens as $item)
                            <tr>
                                <td>{{ $item->numero }}</td>
                                <td>{{ @$item->cliente->nome }}</td>
                                <td>{{ @$item->empresa->nome }}</td>
                                <td>{{ @$item->vara->numero }}</td>
                                <td>{{ @$item->comarca->nome }}</td>
                                <td>{{ $item->data_aud ? \Carbon\Carbon::parse($item->data_aud)->format('d/m/Y') : 'sem data' }}</td>
                                <td>{{ @$item->hora_aud }}</td>
                                <td>
                                    @if (count($item->advogados) > 0)
                                        @foreach ($item->advogados as $advogado)
                                            {{ $advogado->nome }} <br>
                                        @endforeach
                                    @else
                                        {{ $item->usuarioCadastrante->nome ?? 'Sem informações' }}
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editAudienciaModal" data-id="{{ $item->id }}"
                                        data-hora="{{ $item->hora_aud }}" data-data="{{ $item->data_aud }}"><i
                                            class="fas fa-clock"></i></button>
                                    <a href="{{ route('audiencias.modal', $item) }}"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para Edição de Audiência -->
    <div class="modal fade" id="editAudienciaModal" tabindex="-1" role="dialog" aria-labelledby="editAudienciaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAudienciaModalLabel">Editar Audiência</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('audiencias.update') }}" class="m-3">
                    @csrf
                    <input type="hidden" id="id_audiencia" name="id_audiencia">
                    <div class="form-group mt-2">
                        <label for="data_aud">Data da Audiência</label>
                        <input type="date" class="form-control" id="data_aud" name="data_aud">
                    </div>
                    <div class="form-group mt-2">
                        <label for="hora_aud">Hora da Audiência</label>
                        <input type="time" class="form-control" id="hora_aud" name="hora_aud">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Início do script -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#editAudienciaModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var hora = button.data('hora');
                var data = button.data('data');

                var modal = $(this);
                modal.find('#id_audiencia').val(id);
                modal.find('#hora_aud').val(hora);
                modal.find('#data_aud').val(data);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#editAudienciaModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var hora = button.data('hora');
                var data = button.data('data');

                var modal = $(this);
                modal.find('#id_audiencia').val(id);
                modal.find('#hora_aud').val(hora);
                modal.find('#data_aud').val(data);
            });
        });
    </script>
    <!-- Fim do script -->

@endsection

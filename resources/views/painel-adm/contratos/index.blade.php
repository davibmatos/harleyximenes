@extends('templates.painel-adm')
@section('title', 'Contratos')
@section('content')
    <?php
    use Carbon\Carbon;
    @session_start();
    if (@$_SESSION['nivel_usuario'] != 'admin') {
        echo "<script language='javascript'> window.location='./' </script>";
    }
    if (!isset($id)) {
        $id = '';
    }
    
    ?>


    <a href="{{ route('contratos.inserir') }}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir Contrato</a>
    @if ($errors->has('error'))
        <div class="alert alert-danger mt-2">
            {{ $errors->first('error') }}
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-smaller-font" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Edifício</th>
                            <th>Apartamento</th>
                            <th>Valor</th>
                            <th>Dia do Vencimento</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($itens as $item)
                            <tr>
                                <td>{{ $item->inquilino->nome }}</td>
                                <td>{{ preg_replace("/^(\d{3})(\d{3})(\d{3})(\d{2})$/", "$1.$2.$3-$4", $item->inquilino->cpf) }}
                                </td>
                                <td>{{ $item->inquilino->telefone }}</td>
                                <td>{{ $item->apartamento->imovel->edificio }}</td>
                                <td>{{ $item->apartamento->numero }}</td>
                                <td>R${{ number_format($item->apartamento->valor, 2, ',', '.') }}</td>
                                <td>{{ $item->vencimento }}</td>
                                <td>{{ @$item->status->status }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning btn-sm btn-custom" data-toggle="modal"
                                            data-target="#statusModal-{{ $item->id }}">Alterar Status</button>
                                        <button type="button" class="btn btn-warning btn-sm btn-custom" data-toggle="modal"
                                            data-target="#vencimentoModal-{{ $item->id }}">Alterar Vencimento</button>
                                        <button type="button" class="btn btn-danger btn-sm btn-custom" data-toggle="modal"
                                            data-target="#deleteModal-{{ $item->id }}">Excluir</button>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="statusModal-{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="statusModalLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="statusModalLabel-{{ $item->id }}">Alterar
                                                Status do Contrato</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('contratos.updateStatus', $item) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="status-{{ $item->id }}">Status</label>
                                                    <select class="form-control" id="status-{{ $item->id }}"
                                                        name="status_id">
                                                        @foreach ($statuses as $status)
                                                            <option value="{{ $status->id }}"
                                                                {{ $item->status_id == $status->id ? 'selected' : '' }}>
                                                                {{ $status->status }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-warning">Alterar Status</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="vencimentoModal-{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="vencimentoModalLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="vencimentoModalLabel-{{ $item->id }}">Alterar
                                                Data de Vencimento do Contrato</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('contratos.updateVencimento', $item) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="vencimento-{{ $item->id }}">Dia do Vencimento</label>
                                                    <input type="number" class="form-control"
                                                        id="vencimento-{{ $item->id }}" name="vencimento"
                                                        value="{{ $item->vencimento }}" min="1" max="31">

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-warning">Alterar Vencimento</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="vencimentoModal-{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="vencimentoModalLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="vencimentoModalLabel-{{ $item->id }}">Alterar
                                                Data de Vencimento do Contrato</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('contratos.updateVencimento', $item) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="vencimento-{{ $item->id }}">Data de Vencimento</label>
                                                    <input type="date" class="form-control"
                                                        id="vencimento-{{ $item->id }}" name="vencimento"
                                                        value="{{ $item->vencimento }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-warning">Alterar Vencimento</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal-{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deletar Registro</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja Realmente Excluir este Registro?

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                            <form method="POST" action="{{ route('contratos.delete', $item->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').dataTable({
                "ordering": false
            })

        });
    </script>





    <?php
    if (@$id != '') {
        echo "<script>$('#exampleModal').modal('show');</script>";
    }
    ?>

@endsection

@extends('templates.painel-adm')
@section('title', 'Prazos')
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



    <a href="{{ route('prazos.inserir') }}" type="button" class="mt-4 mb-4 btn btn-primary">Novo Prazo</a>
    @if (session('error'))
        <div class="alert alert-danger mt-2">
            {{ session('error') }}
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Processo</th>
                            <th>Descrição</th>
                            <th>Data Inicial</th>
                            <th>Prazo Fatal</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($itens as $item)
                            <tr>
                                <td>{{ $item->processo ? $item->processo->numero : 'Processo não encontrado' }}</td>
                                <td>{{ $item->descricao }}</td>
                                <td>{{ $item->data_ini }}</td>
                                <td>{{ $item->data_fim }}</td>
                                <td
                                    class="
                                    @if ($item->status === 'em aberto') bg-warning 
                                    @elseif ($item->status === 'Cumprido') bg-success 
                                    @elseif ($item->status === 'vencido') bg-danger @endif">
                                    <strong style="color: black;">{{ $item->status }}</strong>
                                </td>
                                <td>
                                    <a href="{{ route('prazos.edit', $item) }}"><i
                                            class="fas fa-edit text-info mr-1"></i></a>
                                    <a href="{{ route('prazos.modal', $item) }}"><i
                                            class="fas fa-trash text-danger mr-1"></i></a>
                                    <form action="{{ route('prazos.complete', $item) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" style="border: none; background: none;">
                                            <i class="fas fa-check text-success mr-1"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deletar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseja Realmente Excluir este Registro?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form method="POST" action="{{ route('prazos.delete', $id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (@$id != '') {
            echo "<script>$('#exampleModal').modal('show');</script>";
        }
        ?>

    @endsection

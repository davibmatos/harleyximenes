@extends('templates.painel-adm')
@section('title', 'Audiências')
@section('content')

{{-- Verificar nível de usuário --}}
@php
  $nivel_usuario = \Session::get('nivel_usuario');
@endphp

@if($nivel_usuario !== 'admin' && $nivel_usuario !== 'adv')
  <script language='javascript'> 
    window.location='./';
  </script>
@endif

{{-- Sua lógica de ID --}}
@php
  $id = $id ?? ''; 
@endphp

<div class="d-flex justify-content-end">
  <form method="GET" action="{{ route('audiencias.index') }}" class="form-inline">
    <div class="form-group">
      <label for="data_inicio" class="mr-2">Data Inicial</label>
      <input type="date" class="form-control mr-2" id="data_inicio" name="data_inicio">
    </div>
    <div class="form-group">
      <label for="data_fim" class="mr-2">Data Final</label>
      <input type="date" class="form-control mr-2" id="data_fim" name="data_fim">
    </div>
    <button type="submit" class="btn btn-primary">Filtrar</button>
  </form>
</div>

<a href="{{route('audiencias.inserir')}}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir Audiência</a>

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
          <th>Parte autora</th>
          <th>Parte ré</th>          
          <th>Vara</th>
          <th>Comarca</th>
          <th>Data</th>
          <th>Hora</th>
          <th>Ações</th>
        </tr>
      </thead>

      <tbody>
      @foreach($itens as $item)
         <tr>
          <td>{{$item->numero}}</td>
            <td>{{@$item->cliente->nome}}</td>
            <td>{{@$item->empresa->nome}}</td>            
            <td>{{@$item->vara->numero}}</td>
            <td>{{@$item->comarca->nome}}</td>
            <td>{{@$item->data_aud}}</td>
            <td>{{@$item->hora_aud}}</td>          
            <td>            
            <a href="{{route('processos.edit', $item)}}"><i class="fas fa-edit text-info mr-1"></i></a>
            <a href="{{route('processos.modal', $item)}}"><i class="fas fa-trash text-danger mr-1"></i></a>
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
  $(document).ready(function () {
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
        <form method="POST" action="{{route('processos.delete', $id)}}">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
      </div>
    </div>
  </div>

<?php 
if(@$id != ""){
  echo "<script>$('#exampleModal').modal('show');</script>";
}
?>

@endsection



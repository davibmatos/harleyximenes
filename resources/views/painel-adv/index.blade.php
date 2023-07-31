@extends('templates.painel-adm')
@section('title', 'Painel do Advogado')
@section('content')

<?php
@session_start();
if (@$_SESSION['nivel_usuario'] != 'admin' || @$_SESSION['nivel_usuario'] != 'advogado') {
    echo "<script language='javascript'> window.location='./' </script>";
}
?>

<style>
 .card {
  border: 1px solid #d1d1d1;
  border-radius: 5px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  background-color: #e6f2ff; /* Altera a cor de fundo dos cards para azul claro */
}

.card-body {
  padding: 20px;
}

.card-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
  text-align: center; /* Centraliza o título do card */
}

.card-divider {
  border-bottom: 1px solid #d1d1d1;
  margin-bottom: 10px;
  padding-bottom: 10px;
}

.card-text {
  font-size: 16px;
  color: #333;
}

.card-stats {
  display: flex;
  justify-content: space-around;
  align-items: center;
  margin-top: 10px;
}

.card-stats-item {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.card-stats-number {
  font-size: 24px;
  font-weight: bold;
  color: #333;
}

.card-stats-label {
  font-size: 14px;
  color: #777;
}
</style>

<div class="container">
  <div class="row">
    @foreach($imoveisData as $imovelData)
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title card-divider">{{ $imovelData['nome'] }}</h5>
            <div class="card-stats">
              <div class="card-stats-item">
                <span class="card-stats-number">{{ $imovelData['disponiveis'] }}</span>
                <span class="card-stats-label">Disponíveis</span>
              </div>
              <div class="card-stats-item">
                <span class="card-stats-number">{{ $imovelData['locados'] }}</span>
                <span class="card-stats-label">Locados</span>
              </div>
              <div class="card-stats-item">
                <span class="card-stats-number">{{ $imovelData['total'] }}</span>
                <span class="card-stats-label">Total</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection
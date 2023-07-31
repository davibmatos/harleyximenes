@extends('templates.painel-adm')
@section('title', 'Painel Financeiro')
@section('content')

<style>
  .card {
    border: 1px solid #d1d1d1;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }

  .card-header {
    background-color: #f5f5f5;
    padding: 10px;
    border-bottom: 1px solid #d1d1d1;
    font-weight: bold;
    color: #333;
  }

  .card-body {
    padding: 20px;
  }

  .card-text {
    font-size: 24px;
    color: #333;
    font-weight: bold;
  }
</style>

@php
  $mesAtual = now()->month;
  $mesAnterior = now()->subMonth()->month;
  $mesAntesDoAnterior = now()->subMonths(2)->month;

  $nomesDosMeses = [
    1 => 'Janeiro',
    2 => 'Fevereiro',
    3 => 'Março',
    4 => 'Abril',
    5 => 'Maio',
    6 => 'Junho',
    7 => 'Julho',
    8 => 'Agosto',
    9 => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
  ];

  $meses = [
    $nomesDosMeses[$mesAtual] => $dadosMesAtual,
    $nomesDosMeses[$mesAnterior] => $dadosMesAnterior,
    $nomesDosMeses[$mesAntesDoAnterior] => $dadosMesAntesDoAnterior,
  ];
@endphp


@foreach ($meses as $mes => $dados)
  <h3>{{ $mes }}</h3>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Valores Recebidos</div>
        <div class="card-body">
          <p class="card-text">R$ {{ number_format($dados['valoresRecebidos'], 2, ',', '.') }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Valores a Receber</div>
        <div class="card-body">
          <p class="card-text">R$ {{ number_format($dados['valoresAReceber'], 2, ',', '.') }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Valores Devidos e não pagos</div>
        <div class="card-body">
          <p class="card-text">R$ {{ number_format($dados['valoresPendentes'], 2, ',', '.') }}</p>
        </div>
      </div>
    </div>
  </div>
@endforeach

@endsection
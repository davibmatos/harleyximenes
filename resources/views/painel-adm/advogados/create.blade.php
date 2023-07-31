@extends('templates.painel-adm')
@section('title', 'Inserir Instrutores')
@section('content')
<h6 class="mb-4"><i>CADASTRO DE ADVOGADOS</i></h6><hr>
<form method="POST" action="{{route('advogados.insert')}}">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="" name="nome" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="" name="email">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone">
                </div>
            </div>
           
        </div>
        
        <p align="right">
        <button type="submit" class="btn btn-primary">Salvar</button>
        </p>
    </form>
@endsection

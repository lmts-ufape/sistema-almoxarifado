
@extends('templates.principal')

@section('title') Cadastrar Deposito @endsection

@section('content')
    <h2>CADASTRO DE DEPÓSITO</h2>
    <form action="{{ route('deposito.store') }}" method="POST">

        @csrf

        <input type="text" name="nome" id="nome" placeHolder="Nome">

        <input type="text" name="codigo" id="codigo" placeHolder="Codigo">

        <input type="submit" value="Enviar">

    </form>

@endsection

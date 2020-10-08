
@extends('templates.principal')

@section('title') Depositos @endsection

@section('content')
    <h1>CONSULTAR DEPÓSITOS</h1>

    <label>Lista de Depositos:</label>

    </br>

    <select name="selectDeposito">
        <option>Depositos</option>
        @foreach($depositos as $d)
            <option> {{$d->nome}} </option>
        @endforeach
    </select>

    {{-- {{ $deposito =  $_post['selectDeposito'] }}

    @foreach($estoques as $estoque)
        @if($estoque->deposito_id == $deposito)
            <b>Material:</b> {{ $material->nome }} |
            <b>Quantidade:</b> {{ $material->quantidade }} |
        @endif
    @endforeach --}}
@endsection


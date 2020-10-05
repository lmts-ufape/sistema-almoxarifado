
@extends('templates.principal')

@section('title') Depositos @endsection

@section('content')
    <h1>CONSULTAR DEPÓSITOS</h1>

    <label>Lista de Depositos:</label>

    </br>

    <select id="select_deposito">

        @foreach($depositos as $d)
            <option> {{$d->nome}} </option>
        @endforeach

    </select>

@endsection


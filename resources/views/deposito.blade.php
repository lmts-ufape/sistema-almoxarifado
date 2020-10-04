
@extends('templates.principal')

@section('title') Depositos @endsection

@section('content')

    <a href="{{url('criarDeposito')}}"> Cadastrar Deposito </a>

    </br>

    <label>Lista de Depositos:</label>

    </br>

    <select id="select_deposito">

        @foreach($depositos as $d)
            <option> {{$d->nome}} </option>
        @endforeach

    </select>

@endsection


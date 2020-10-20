
@extends('../principal')

@section('title')
    Deposito - {{ $deposito->nome }}
@endsection

@section('content')
    <p> Deposito: {{ $deposito->nome }} </p>
    <p> Codigo: {{ $deposito->codigo }} </p>
@endsection

@extends('../templates.principal')

@section('title')
    Deposito Create
@endsection

@section('content')

    <form action="{{ route('deposito.store') }}" method="POST">

        @csrf

        <label for="nome"> Nome: </label>
        <input type="text" name="nome" id="nome">
        
        <label for="codigo"> Código: </label>
        <input type="text" name="codigo" id="codigo">
        
    <input type="submit" value="Enviar">

@endsection

@extends('../templates.principal')

@section('title')
    Deposito Edit
@endsection

@section('content')

    <form action="{{ route('deposito.update', $deposito->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label for="nome"> Nome: </label>
        <input type="text" name="nome" id="nome" value="{{ $deposito->nome }}">
        
        <label for="codigo"> Código: </label>
        <input type="text" name="codigo" id="codigo" value="{{ $deposito->codigo }}" disabled>
        
    <input type="submit" value="Salvar">

@endsection
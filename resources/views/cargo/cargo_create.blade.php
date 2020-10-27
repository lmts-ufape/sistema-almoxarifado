

@extends('../templates.principal')

@section('title')
    Cargo Create
@endsection

@section('content')

    <form action="{{ route('cargo.store') }}" method="POST">
    
        @csrf

        <label for="nome"> Nome: </label>
        <input type="text" name="nome" id="nome">

        <input type="submit" value="Enviar">
    
    </form>

@endsection
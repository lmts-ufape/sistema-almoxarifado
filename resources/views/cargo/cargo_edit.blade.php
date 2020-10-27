

@extends('../templates.principal')

@section('title')
    Cargo Edit
@endsection

@section('content')

    <form action="{{ route('cargo.update', $cargo->id) }}" method="POST">
    
        @csrf
        @method('PUT')

        <label for="nome"> Nome: </label>
        <input type="text" name="nome" id="nome" value="{{ $cargo->nome }}">

        <input type="submit" value="Salvar">
    
    </form>

@endsection
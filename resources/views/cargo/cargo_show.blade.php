

@extends('../templates.principal')

@section('title')
    Cargo - {{ $cargo->nome }}
@endsection

@section('content')

    <p> Cargo: {{ $cargo->nome }}</p>

@endsection
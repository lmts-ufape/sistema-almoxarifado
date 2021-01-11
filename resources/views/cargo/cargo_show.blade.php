@extends('../templates.principal')

@section('title')
    Perfil - {{ $cargo->nome }}
@endsection

@section('content')
    <p> Perfil: {{ $cargo->nome }}</p>
@endsection

@extends('templates.principal')

@section('title') Cadastrar Material @endsection

@section('content')
    <div>
        <h2>MATERIAIS CADASTRADOS</h2>

        <ul>
            @forelse($materials as $material)
                <li> <a href="{{ route('material.edit', ['material' => $material->id]) }}">
                    <b>Material:</b> {{ $material->nome }} |
                     <b>Código:</b> {{ $material->codigo }} |
                     <b>Quantidade mínima:</b> {{ $material->quantidade_minima }} |
                     <b>Descrição:</b> {{ $material->descricao }}</a></li>
            @empty
                <p>Sem materiais cadastrados ainda</p>
            @endempty

        </ul>
    <div>
@endsection

@extends('layout')

@section('content')
    <div>
        <h1>CONSULTAR MATERIAIS</h1>
        {{-- <a href="{{ route('material.create') }}">Cadastrar novo material</a> --}}

        <ul>
            @forelse($materials as $material)
                <li> <a href="route('material.edit', ['material' => $material->id])">
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

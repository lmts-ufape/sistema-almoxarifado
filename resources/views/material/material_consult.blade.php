@extends('templates.principal')

@section('title') Cadastrar Material @endsection

@section('content')
    <div>
        <h2>CONSULTAR MATERIAIS</h2>

        <ul>
            @forelse($materials as $material)
            @php
                $quantidadeTotal = 0;
                foreach ($estoques as $estoque) {
                    if($estoque->material_id == $material->id){
                        $quantidadeTotal += $estoque->quantidade;
                    }
                }
            @endphp

                <li>
                        <b>Material:</b> {{ $material->nome }} |
                        <b>Código:</b> {{ $material->codigo }} |
                        <b>Quantidade total:</b> {{ $quantidadeTotal }} |
                        <b>Quantidade mínima:</b> {{ $material->quantidade_minima }} |
                        <b>Descrição:</b> {{ $material->descricao }}

                </li>
            @empty
                <p>Sem materiais cadastrados ainda</p>
            @endempty

        </ul>
    <div>
@endsection

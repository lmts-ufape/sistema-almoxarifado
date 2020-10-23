@extends('templates.principal')

@section('title') Cadastrar Material @endsection

@section('content')
    <h2>CADASTRO DE MATERIAL</h2>

    <form method="POST" action="{{ route('material.store') }}">

        @csrf

        <p>
            <label>Nome:</label>
            <input type="text" name="nome" value="{{ old('nome') }}">
        </p>

        <p>
            <label>Código:</label>
            <input type="text" name="codigo" value="{{ old('codigo') }}">
        </p>

        <p>
            <label>Quantidade mínima:</label>
            <input type="number" name="quantidade_minima" value="{{ old('quantidade_minima') }}">
        </p>

        {{-- <p>
            <label>Imagem:</label>
            <input type="image" name="imagem_material">
        </p> --}}

        <p>
            <label>Descrição:</label>
            <input type="text" name="descricao" value="{{ old('descricao') }}">
        </p>

        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit">CADASTRAR</button>
    </form>
@endsection

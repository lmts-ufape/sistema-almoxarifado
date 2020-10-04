@extends('layout')

@section('content')
    <h2>CADASTRO DE MATERIAL</h2>
    <form method="POST" action="{{ route('material.update', ['material' => $material->id]) }}">

        @csrf
        @method('PUT')

        <p>
            <label>Nome:</label>
            <input type="text" name="nome" value="{{ old('nome', $material->nome) }}">
        </p>

        <p>
            <label>Código:</label>
            <input type="text" name="codigo" value="{{ old('codigo', $material->codigo) }}">
        </p>

        <p>
            <label>Quantidade mínima:</label>
            <input type="number" name="quantidade_minima" value="{{ old('quantidade_minima', $material->quantidade_minima) }}">
        </p>

        {{-- <p>
            <label>Imagem:</label>
            <input type="image" name="imagem_material" value="{{ old('image', $material->image) }}">
        </p> --}}

        <p>
            <label>Descrição:</label>
            <input type="text" name="descricao" value="{{ old('descricao', $material->descricao) }}">
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

        <button type="submit">ATUALIZAR</button>

    </form>
    <form method="POST" action="{{ route('material.destroy', ['material' => $material->id]) }}">

        @csrf
        @method('DELETE')
        <button type="submit">EXCLUIR</button>
    </form>
@endsection

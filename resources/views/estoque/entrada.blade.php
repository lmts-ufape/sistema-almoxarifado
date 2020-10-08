@extends('templates.principal')

@section('title') Entrada de Material @endsection

@section('content')
    <h2>ENTRADA DE MATERIAL</h2>

    <form method="POST" action="{{ route('estoque.store') }}">

        @csrf

        <p>
            <select name="material_id">
                <option>Material</option>
                @foreach($materiais as $material)
                    <option value="{{$material->id}}"> {{ $material->id }}. {{ $material->nome }} </option>
                @endforeach
            </select>
        </p>

        <p>
            <select name="deposito_id">
                <option >Deposito</option>
                @foreach($depositos as $deposito)
                    <option value="{{ $deposito->id }}"> {{ $deposito->id }}. {{$deposito->nome}} </option>
                @endforeach

            </select>
        </p>

        <p>
            <label>Quantidade:</label>
            <input type="number" name="quantidade">
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
        <button type="submit">REGISTRAR ENTRADA</button>
    </form>
@endsection

@extends('templates.principal')

@section('title') Entrada de Material @endsection

@section('content')
    <h2>TRANSFERÊNCIA DE MATERIAL</h2>

    <form method="POST" action="{{ route('movimento.transferenciaStore') }}">

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
            <select name="deposito_id_origem">
                <option >Deposito de Origem</option>
                @foreach($depositos as $deposito)
                    <option value="{{ $deposito->id }}"> {{ $deposito->id }}. {{$deposito->nome}} </option>
                @endforeach

            </select>
            <select name="deposito_id_destino">
                <option >Deposito de Destino</option>
                @foreach($depositos as $deposito)
                    <option value="{{ $deposito->id }}"> {{ $deposito->id }}. {{$deposito->nome}} </option>
                @endforeach

            </select>
        </p>

        <p>
            <label>Quantidade:</label>
            <input type="number" name="quantidade"  value="{{ old("quantidade") }}">
        </p>

        <p>
            <label>Descrição:</label>
            <input type="text" name="descricao"  value="{{ old("descricao") }}">
        </p>

        <input type="hidden" name="operacao" value="2">

        @if(session()->has('erro'))
            <p style="color: red">
                {{ session()->get('erro') }}
            </p>
        @endif
        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit">REGISTRAR SAÍDA</button>
    </form>
@endsection

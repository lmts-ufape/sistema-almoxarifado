@extends('templates.principal')

@section('title') Entrada de Material @endsection

@section('content')
    <h2>SAÍDA DE MATERIAL</h2>

    <form method="POST" action="{{ route('movimento.saidaStore') }}">

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
            <input type="number" name="quantidade"  value="{{ old("quantidade") }}">
        </p>

        <p>
            <label>Descrição:</label>
            <input type="text" name="descricao"  value="{{ old("descricao") }}">
        </p>

        <input type="hidden" name="operacao" value="1">

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
        <button class="btn btn-danger" type="submit">Retirar</button>
    </form>
@endsection



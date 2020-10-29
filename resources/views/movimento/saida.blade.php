@extends('templates.principal')

@section('title') Entrada de Material @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>SAÍDA DE MATERIAL</h2>
    </div>

    <form method="POST" action="{{ route('movimento.saidaStore') }}">

        @csrf

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputMaterial">Material</label>
                <select id="inputMaterial" class="form-control" name="material_id">
                    <option selected hidden>Escolher...</option>
                    @foreach($materiais as $material)
                        <option value="{{$material->id}}"> {{ $material->id }}. {{ $material->nome }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputDeposito">Depósito</label>
                <select id="inputDeposito" class="form-control" name="deposito_id">
                    <option selected hidden>Escolher...</option>
                    @foreach($depositos as $deposito)
                        <option value="{{ $deposito->id }}"> {{ $deposito->id }}. {{$deposito->nome}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputQuantidade">Quantidade</label>
                <input type="number" class="form-control" id="inputQuantidade" name="quantidade" value="{{ old('quantidade') }}">
            </div>
        </div>
            <div>
                <div class="form-group col-md-12" class="form-row" style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
                    <label for="inputDescricao">Descrição</label>
                    <textarea class="form-control" name="descricao" id="inputDescricao" cols="30" rows="3" value="{{ old('descricao') }}"></textarea>
                </div>
            </div>

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



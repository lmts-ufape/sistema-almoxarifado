@extends('templates.principal')

@section('title') Cadastrar Material @endsection

@section('content')
    <div>
        <h2>CADASTRAR MATERIAL</h2>
    </div>

    <form method="POST" action="{{ route('material.store') }}">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="inputMaterial">Material</label>
            <input type="text" class="form-control" id="inputMaterial" name="nome" placeholder="Material" value="{{ old('nome') }}">
          </div>
          <div class="form-group col-md-2">
            <label for="inputCodigo">Código</label>
            <input type="text" class="form-control" id="inputCodigo" name="codigo" placeholder="Código" value="{{ old('codigo') }}">
          </div>
          <div class="form-group col-md-2">
            <label for="inputQuantidadeMin">Quantidade mínima</label>
            <input type="number" class="form-control" id="inputQuantidadeMin" name="quantidade_minima" value="{{ old('quantidade_minima') }}">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputDescricao">Descrição</label>
            <textarea class="form-control" name="descricao" id="inputDescricao" cols="30" rows="3" value="{{ old('descricao') }}"></textarea>
          </div>
        </div>

        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-success">Salvar</button>
      </form>


@endsection

@extends('templates.principal')

@section('title') Cadastrar Material @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding: 5px; margin-bottom: 10px">
        <h2>CADASTRAR MATERIAL</h2>
    </div>

    <form method="POST" action="{{ route('material.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label for="imagem"> Selecione uma Imagem </label>
                <input class="form-control-file" type="file" name="imagem" id="imagem" accept=".png, .jpg, .jpeg, .svg, .dib, .bmp" >
            </div>
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
                <input type="number" class="form-control" id="inputQuantidadeMin" name="quantidade_minima" min="0" value="{{ old('quantidade_minima') }}">
            </div>
        </div>
        <div  >
            <div class="form-group col-md-12" class="form-row" style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
                <label for="inputDescricao">Descrição</label>
                <textarea class="form-control" name="descricao" id="inputDescricao" cols="30" rows="3">{{ old('descricao') }}</textarea>
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

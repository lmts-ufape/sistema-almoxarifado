@extends('templates.principal')

@section('title') Editar Material @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>EDITAR MATERIAL</h2>
    </div>

    <form method="POST" action="{{ route('material.update', ['material' => $material->id]) }}" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-row">
          <div class="form-group">
            <label for="imagem"> Selecione uma Imagem </label>
            <input class="form-control-file" type="file" name="imagem" id="imagem" accept=".png, .jpg, .jpeg, .svg, .dib, .bmp" >
          </div>
          <div class="form-group col-md-3">
            <label for="inputMaterial">Material</label>
            <input type="text" class="form-control" id="inputMaterial" name="nome" placeholder="Material" value="{{ old('nome', $material->nome) }}">
          </div>
          <div class="form-group col-md-2">
            <label for="inputCodigo">Código</label>
            <input type="text" class="form-control" id="inputCodigo" name="codigo" placeholder="Código" value="{{ old('codigo', $material->codigo) }}">
          </div>
          <div class="form-group col-md-2">
            <label for="inputQuantidadeMin">Quantidade mínima</label>
            <input type="number" class="form-control" id="inputQuantidadeMin" name="quantidade_minima" value="{{ old('quantidade_minima', $material->quantidade_minima) }}">
          </div>
        </div>
        <div>
          <div div class="form-group col-md-12" class="form-row" style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
            <label for="inputDescricao">Descrição</label>
            <textarea class="form-control" name="descricao" id="inputDescricao" cols="30" rows="3">{{ old('descricao', $material->descricao) }}</textarea>
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


        <div class="form-row">
            <div class="col-sm-1">
                <Button class="btn btn-secondary" type="button" onClick="location.href='../'"> Cancelar </Button>
            </div>
            <div class="col-sm-1">
                <Button type="button" class="btn btn-danger"> Remover </Button>
            </div>
            <div class="col-sm-1">
                <Button class="btn btn-success" type="submit"> Atualizar </Button>
            </div>
        </div>


    </form>
    {{-- <form method="POST" action="{{ route('material.destroy', ['material' => $material->id]) }}">

        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Remover</button>
    </form> --}}
@endsection

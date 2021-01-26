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
                <label for="imagem"> Selecione uma imagem </label>
                <input class="form-control-file @error('imagem') is-invalid @enderror" type="file" 
                    name="imagem" id="imagem" accept=".png, .jpg, .jpeg, .svg, .dib, .bmp" >
                @error('imagem')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="inputMaterial">Material</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="inputMaterial" 
                    name="nome" placeholder="Material" autofocus autocomplete="inputMaterial" onkeypress="return onlyLetters(event,this);" value="{{ old('nome') }}">
                @error('nome')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-2">
                <label for="inputCodigo">Código</label>
                <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="inputCodigo" 
                    name="codigo" placeholder="Código" onkeypress="return onlyNums()" value="{{ old('codigo') }}" autofocus>
                @error('codigo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-2">
                <label for="inputQuantidadeMin">Quantidade mínima</label>
                <input type="number" class="form-control @error('quantidade_minima') is-invalid @enderror" id="inputQuantidadeMin" 
                    name="quantidade_minima" onkeypress="return onlyNums()" autofocus min="0" value="{{ old('quantidade_minima') }}">
                @error('quantidade_minima')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div  >
            <div class="form-group col-md-12" class="form-row" style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
                <label for="inputDescricao">Descrição</label>
                <textarea class="form-control @error('descricao') is-invalid @enderror" autofocus 
                    name="descricao" id="inputDescricao" cols="30" rows="3">{{ old('descricao') }}</textarea>
                @error('descricao')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>

                @enderror
            </div>
        </div>
        <Button class="btn btn-secondary" type="button" onclick="if(confirm('Tem certeza que deseja Cancelar o cadastro do Material?')) location.href = '../' "> Cancelar </Button>
        <button type="submit" class="btn btn-success">Salvar</button>
      </form>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/CheckLettersNumbers.js')}}"></script>
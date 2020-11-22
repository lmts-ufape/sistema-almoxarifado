
@extends('../templates.principal')

@section('title')
    Editar Depósito
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>EDITAR DEPÓSITO</h2>
    </div>

    <form action="{{ route('deposito.update', $deposito->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-row" style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
            <div class="form-group col-md-3">
                <label for="nome">Nome do depósito</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Depósito" value="{{ old('nome', $deposito->nome) }}">
            </div>
            <div class="form-group col-md-2" >
                <label for="inputCodigo">Código</label>
                <input type="text" class="form-control" id="inputCodigo" name="codigo" placeholder="Código" value="{{ old('codigo', $deposito->codigo) }}">
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

        <input class="btn btn-success" type="submit" value="Atualizar">
    </form>
    <form action="{{ route('deposito.destroy', $deposito->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <Button class="btn btn-danger" type="submit"> Remover </Button>
    </form>

@endsection

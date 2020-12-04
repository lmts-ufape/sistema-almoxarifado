
@extends('../templates.principal')

@section('title')
    Cadastrar Depósito
@endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CADASTRAR DEPÓSITO</h2>
    </div>

    <form action="{{ route('deposito.store') }}" method="POST">

        @csrf
        <div class="form-row" style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
            <div class="form-group col-md-3">
                <label for="nome">Nome do depósito</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" autofocus id="nome" name="nome" placeholder="Depósito" value="{{ old('nome') }}">
                @error('nome')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>

                @enderror
            </div>
            <div class="form-group col-md-2" >
                <label for="inputCodigo">Código</label>
                <input type="text" class="form-control @error('codigo') is-invalid @enderror" autofocus id="inputCodigo" name="codigo" placeholder="Código" value="{{ old('codigo') }}">
                @error('codigo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>

                @enderror
            </div>
        </div>

        <Button class="btn btn-secondary" type="button" onclick="if(confirm('Tem certeza que deseja Cancelar o cadastro do Deposito?')) location.href = '../' "> Cancelar </Button>
        <input class="btn btn-success" type="submit" value="Salvar">

@endsection

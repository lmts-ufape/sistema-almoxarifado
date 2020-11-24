
@extends('templates.principal')

@section('title')
    Novo Usuario
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding: 5px; margin-bottom: 10px">
        <h2>CADASTRAR USUÁRIO</h2>
    </div>

    <form action="{{ route('usuario.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="form-group">

            <div class="form-group">
                <h2 class="h4"> Dados Institucionais / Pessoais </h2>
            </div>

            <div class="form-group">
                <label for="imagem"> Selecione uma Imagem </label>
                <input class="form-control-file" type="file" name="imagem" id="imagem" accept=".png, .jpg, .jpeg, .svg, .dib, .bmp" >
            </div>
            
            <div class="form-group">
                <label for="nome"> Nome Completo </label>
                <input class="form-control" type="text" name="nome" id="nome" placeHolder="Nome Completo">
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="cpf"> CPF </label>
                    <input class="form-control" type="text" name="cpf" id="cpf" placeHolder="000.000.000-00">
                </div>

                <div class="form-group col-md-2">
                    <label for="rg"> RG </label>
                    <input class="form-control" type="text" name="rg" id="rg" placeHolder="00.000.000">
                </div>

                <div class="form-group">
                    <label for="data_nascimento"> Data de Nascimento </label>
                    <input class="form-control" type="date" name="data_nascimento" id="data_nascimento" min="1910-01-01" max="2020-12-31">
                </div>

                <div class="form-group col-md-2">
                    <label for="matricula"> Matrícula do Siga </label>
                    <input class="form-control" type="number" name="matricula" id="matricula" placeHolder="000000000">
                </div>

                <div class="form-group">
                    <label for="cargo"> Cargo </label>
                    <select class="custom-select" name="cargo" id="cargo">
                    <option value="0" selected="selected">Escolha...</option>
                    @foreach( $cargos as $cargo )
                        <option value="{{ $cargo->id }}"> {{ $cargo->nome }} </option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <h2 class="h4"> Dados de Login </h2>
            </div>

            <div class="form-group">
                <label for="email"> Email </label>
                <input class="form-control" type="email" name="email" id="email" placeHolder="exemplodeemail@upe.br">
            </div>

            <div class="form-group">
                <label for="senha"> Senha </label>
                <input class="form-control" type="password" name="senha" id="senha" placeHolder="">
            </div>

            <div class="form-group">
                <label for="confimar_senha"> Confirmar Senha </label>
                <input class="form-control" type="password" name="confirmar_senha" id="confirmar_senha" placeHolder="">
            </div>

            <div class="form-group col-md-12" class="form-row" style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
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

            <Button class="btn btn-secondary" type="button" onclick="location.href = '../' "> Cancelar </Button>
            <Button class="btn btn-success" type="submit"> Cadastrar </Button>

        </div>

    </form>

@endsection
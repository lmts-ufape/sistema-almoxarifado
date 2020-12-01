@extends('templates.principal')

@section('title')
    Editar Usuário
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding: 5px; margin-bottom: 10px">
        <h2>Editar Usuário</h2>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <form action="{{ route('usuario.update', $usuario->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class="form-group">
                <h2 class="h4"> Dados Institucionais / Pessoais </h2>
            </div>

            <div class="form-group">
                <label for="nome"> Nome Completo </label>
                <input class="form-control" type="text" name="nome" id="nome" placeHolder="Nome Completo"
                       value="{{ $usuario->nome }}">
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="cpf"> CPF </label>
                    <input class="form-control" type="text" name="cpf" id="cpf" placeHolder="000.000.000-00"
                           value="{{ $usuario->cpf }}">
                </div>

                <div class="form-group col-md-2">
                    <label for="rg"> RG </label>
                    <input class="form-control" type="text" name="rg" id="rg" placeHolder="00.000.000"
                           value="{{ $usuario->rg }}">
                </div>

                <div class="form-group">
                    <label for="data_nascimento"> Data de Nascimento </label>
                    <input class="form-control" type="date" name="data_nascimento" id="data_nascimento" min="1910-01-01" max="2020-12-31"
                           value="{{ $usuario->data_nascimento }}">
                </div>

                <div class="form-group col-md-2">
                    <label for="matricula"> Matrícula </label>
                    <input class="form-control" type="number" name="matricula" id="matricula" placeHolder="000000000"
                           value="{{ $usuario->matricula }}">
                </div>
                @if(Auth::user()->cargo_id == 2)
                    <div class="form-group">
                        <label for="cargo"> Perfil </label>
                        <select class="custom-select" name="cargo" id="cargo">
                            <option value="{{ $usuario->cargo_id }}"
                                    selected="selected">{{ $usuario->getCargo($usuario->cargo_id)->nome }}</option>
                            @foreach( $cargos as $cargo )
                                @if( $cargo->id != $usuario->cargo_id )
                                    <option value="{{ $cargo->id }}"> {{ $cargo->nome }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @else
                    <input type="hidden" id="cargo" name="cargo" value="{{$usuario->cargo_id}}">
                @endif
            </div>

            <div class="form-group">
                <h2 class="h4"> Dados de Login </h2>
            </div>

            <div class="form-group">
                <label for="email"> E-mail </label>
                <input class="form-control" type="email" name="email" id="email" placeHolder="exemplodeemail@upe.br"
                       value="{{ $usuario->email }}">
            </div>

            <div class="form-group">
                <label for="senha"> Senha </label>
                <input class="form-control" type="password" name="senha" id="senha" placeHolder="">
            </div>

            <div class="form-group">
                <label for="confimar_senha"> Confirmar Senha </label>
                <input class="form-control" type="password" name="confirmar_senha" id="confirmar_senha" placeHolder="">
            </div>

            <div class="form-group col-md-12" class="form-row"
                 style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
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

        </div>
    </form>
@endsection

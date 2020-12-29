@extends('templates.principal')

@section('title')
    Editar Perfil
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding: 5px; margin-bottom: 10px">
        <h2>EDITAR PERFIL</h2>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <form action="{{ route('usuario.update_perfil', $usuario->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class="form-group">
                <label for="nome"> Nome Completo </label>
                <input class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" id="nome"
                       max="100" onkeypress="return onlyLetters(event,this);" placeHolder="Nome Completo"
                       value="{{ $usuario->nome }}">

                @error('nome')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="cpf"> CPF </label>
                    <input class="form-control @error('cpf') is-invalid @enderror" type="number" name="cpf" id="cpf"
                           min="0" max="99999999999" oninput="return cpfLength();"
                           onkeypress="return onlyNums(event,this);" placeHolder="00000000000"
                           value="{{ $usuario->cpf }}">

                    @error('cpf')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="rg"> RG </label>
                    <input class="form-control @error('rg') is-invalid @enderror" type="number" name="rg" id="rg"
                           min="0" max="99999999999" oninput="return rgLength();"
                           onkeypress="return onlyNums(event,this);" placeHolder="00000000"
                           value="{{ $usuario->rg }}">

                    @error('rg')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="data_nascimento"> Data de Nascimento </label>
                    <input class="form-control @error('data_nascimento') is-invalid @enderror" type="date"
                           name="data_nascimento" id="data_nascimento" min="1910-01-01" max="2020-12-31"
                           value="{{ $usuario->data_nascimento }}">

                    @error('data_nascimento')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="matricula"> Matrícula </label>
                    <input class="form-control @error('matricula') is-invalid @enderror" type="number" name="matricula"
                           id="matricula" min="0" max="99999999999" oninput="return matriculaLength();"
                           onkeypress="return onlyNums(event,this);" placeHolder="000000000"
                           value="{{ $usuario->matricula }}">

                    @error('matricula')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="setor"> Setor </label>
                    <select id="setor" class="form-control" name="setor">
                        @if($usuario->setor == 'Administrativo')
                            <option selected value="Administrativo">Administrativo</option>
                            <option value="Academico">Academico</option>
                            <option value="Administrativo/Academico">Administrativo/Academico</option>
                        @elseif($usuario->setor == 'Academico')
                            <option value="Administrativo">Administrativo</option>
                            <option selected value="Academico">Academico</option>
                            <option value="Administrativo/Academico">Administrativo/Academico</option>
                        @else
                            <option value="Administrativo">Administrativo</option>
                            <option value="Academico">Academico</option>
                            <option selected value="Administrativo/Academico">Administrativo/Academico</option>
                        @endif
                    </select>
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
                <label for="numTel"> Número de Celular </label>
                <input class="form-control @error('numTel') is-invalid @enderror" type="number" name="numTel"
                       id="numTel" min="0" max="99999999999" oninput="return numTelLength();"
                       onkeypress="return onlyNums(event,this);" placeHolder="00000000000"
                       value="{{ $usuario->numTel }}">

                @error('numTel')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email"> E-mail </label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email"
                       placeHolder="exemplodeemail@upe.br"
                       value="{{ $usuario->email }}">

                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group col-md-12" class="form-row"
                 style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
            </div>

            <div class="form-row">
                <div class="col-sm-auto">
                    <a href="{{ route('home') }}" class="btn btn-secondary"
                       onclick="return confirm('Tem certeza que deseja cancelar a alteração do perfil do Usuário?')">
                        Cancelar </a>
                </div>
                <div class="col-sm-auto">
                    <Button class="btn btn-success" type="submit" disabled
                            onclick="return confirm('Tem certeza que deseja atualizar o perfil do Usuário?')"
                            id="atualizar"> Atualizar
                    </Button>
                </div>
            </div>

        </div>
    </form>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/usuario/edit.js')}}"></script>

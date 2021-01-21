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
                <label for="nome"> Nome Completo </label>
                <input class="form-control  @error('nome') is-invalid @enderror" type="text" name="nome" id="nome"
                       onkeypress="return onlyLetters();" maxlength="100" value="{{ old('nome') }}"
                       autocomplete="nome" autofocus placeHolder="Nome Completo">
                @error('nome')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="numTel">{{ __('Celular') }}</label>
                    <input id="numTel" type="number" min="0" max="99999999999" oninput="return numTelLength();"
                           onkeypress="return onlyNums();"
                           class="form-control @error('numTel') is-invalid @enderror" name="numTel"
                           value="{{ old('numTel') }}" required autocomplete="numTel" placeholder="00000000000">

                    @error('numTel')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label for="cpf"> CPF </label>
                    <input type="text" name="cpf" id="cpf" class="form-control @error('cpf') is-invalid @enderror"
                           onkeypress="return onlyNums();" oninput="return cpfLength();" value="{{ old('cpf') }}"
                           autocomplete="cpf" autofocus placeHolder="000.000.000-00">
                    @error('cpf')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label for="rg"> RG </label>
                    <input name="rg" id="rg" class="form-control @error('rg') is-invalid @enderror"
                           onkeypress="return onlyNums();" oninput="return rgLength();" value="{{ old('rg') }}"
                           type="text" autocomplete="rg" autofocus placeHolder="00.000.000">
                    @error('rg')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label for="data_nascimento"> Data de Nascimento </label>
                    <input class="form-control @error('data_nascimento') is-invalid @enderror"
                           value="{{ old('data_nascimento') }}" autofocus type="date" name="data_nascimento"
                           id="data_nascimento" min="1910-01-01">
                    @error('data_nascimento')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label for="matricula"> Matrícula </label>
                    <input class="form-control @error('matricula') is-invalid @enderror"
                           onkeypress="return onlyNums();" oninput="return matriculaLength();"
                           value="{{ old('matricula') }}" type="number" name="matricula" id="matricula"
                           autocomplete="matricula" autofocus placeHolder="000000000">
                    @error('matricula')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label for="setor"> Setor </label>
                    <select id="setor" class="form-control" name="setor">
                        <option data-value="Administrativo">Administrativo</option>
                        <option data-value="Academico">Academico</option>
                        <option data-value="Administrativo/Academico">Administrativo/Academico</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cargo"> Perfil </label>
                    <select class="custom-select @error('cargo') is-invalid @enderror" autofocus name="cargo"
                            id="cargo">
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
                <label for="email"> E-mail </label>
                <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                       autocomplete="email" autofocus type="email" name="email" id="email"
                       placeHolder="exemplodeemail@upe.br">
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="senha"> Senha contendo ao menos 8 dígitos </label>
                <input class="form-control @error('senha') is-invalid @enderror" autofocus autocomplete="new-password"
                       type="password" name="password" id="password" placeHolder="">
                @error('senha')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="confimar_senha"> Confirmar Senha </label>
                <input class="form-control @error('confirmar_senha') is-invalid @enderror" autocomplete="new-password"
                       autofocus type="password" name="password_confirmation" id="password_confirmation" placeHolder="">
                @error('confirmar_senha')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-12" class="form-row"
                 style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
            </div>
            <Button class="btn btn-secondary" type="button"
                    onclick="if(confirm('Tem certeza que deseja Cancelar o cadastro do Usuário?')) location.href = '../' ">
                Cancelar
            </Button>
            <Button class="btn btn-success" type="submit"> Cadastrar</Button>
        </div>
    </form>

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/usuario/register.js')}}"></script>
<script type="text/javascript" src="{{asset('js/CheckLettersNumbers.js')}}"></script>

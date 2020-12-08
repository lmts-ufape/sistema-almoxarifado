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
                <input class="form-control  @error('nome') is-invalid @enderror" type="text" name="nome" id="nome" onkeypress="return onlyLetters(event,this);" maxlength="100" value="{{ old('nome', $usuario->nome) }}" autocomplete="nome" autofocus placeHolder="Nome Completo">
                @error('nome')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="cpf"> CPF </label>
                    <input class="form-control @error('cpf') is-invalid @enderror" onkeypress="return onlyNums();" oninput="return cpfLength();" value="{{ old('cpf', $usuario->cpf) }}" type="text" name="cpf" id="cpf" autocomplete="cpf" autofocus placeHolder="000.000.000-00">
                    @error('cpf')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="rg"> RG </label>
                    <input class="form-control @error('rg') is-invalid @enderror" onkeypress="return onlyNums();" oninput="return rgLength();" value="{{ old('rg', $usuario->rg) }}" type="text" name="rg" id="rg" autocomplete="rg" autofocus placeHolder="00.000.000">
                    @error('rg')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="data_nascimento"> Data de Nascimento </label>
                    <input class="form-control @error('data_nascimento') is-invalid @enderror" autofocus value="{{ old('data_nascimento', $usuario->data_nascimento) }}" type="date" name="data_nascimento" id="data_nascimento" min="1910-01-01" max="2020-12-31">
                    @error('data_nascimento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="matricula"> Matrícula </label>
                    <input class="form-control @error('matricula') is-invalid @enderror" onkeypress="return onlyNums();" onkeypress="return onlyNums(event,this);" oninput="return matriculaLength();" value="{{ old('matricula', $usuario->matricula) }}" type="number" name="matricula" id="matricula" autocomplete="matricula" autofocus placeHolder="000000000">
                    @error('matricula')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @if(Auth::user()->cargo_id == 2)
                <div class="form-group">
                    <label for="cargo"> Perfil </label>
                    <select class="custom-select @error('cargo') is-invalid @enderror" autofocus name="cargo" id="cargo">
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
                <label for="email"> Número de Celular </label>
                <input class="form-control @error('numTel') is-invalid @enderror" type="number" name="numTel" id="numTel" min="0" max="99999999999" oninput="return numTelLength();"  onkeypress="return onlyNums(event,this);" placeHolder="00000000000"
                       value="{{ $usuario->numTel }}">

                @error('numTel')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>  

            <div class="form-group">
                <h2 class="h4"> Dados de Login </h2>
            </div>

            <div class="form-group">
                <label for="email"> E-mail </label>
                <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $usuario->email) }}" autocomplete="email" autofocus type="email" name="email" id="email" placeHolder="exemplodeemail@upe.br">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- <div class="form-group">
                <label for="senha"> Senha contendo ao menos 8 dígitos </label>
                <input class="form-control @error('senha') is-invalid @enderror" autofocus autocomplete="new-password" type="password" name="password" id="password" placeHolder="">
                @error('senha')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="confimar_senha"> Confirmar Senha </label>
                <input class="form-control @error('confirmar_senha') is-invalid @enderror" autocomplete="new-password" autofocus type="password" name="password_confirmation" id="password_confirmation" placeHolder="">
                @error('confirmar_senha')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> -->

            <div class="form-row">
                <div class="col-sm-1">
                    <Button class="btn btn-secondary" type="button" onClick="if(confirm('Tem certeza que deseja Cancelar a alteração do Usuário?')) location.href='../'"> Cancelar </Button>
                </div>
                <div class="col-sm-1">
                    <Button type="button" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja Remover o Usuário?')"> Remover </Button>
                </div>
                <div class="col-sm-1">
                    <Button class="btn btn-success" type="submit" onclick="return confirm('Tem certeza que deseja Atualizar o Usuário?')"> Atualizar </Button>
                </div>
            </div>

        </div>
    </form>
@endsection
<script>
    function onlyLetters(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            } else if (e) {
                var charCode = e.which;
            } else {
                return true;
            }
            if (
                (charCode > 64 && charCode < 91) ||
                (charCode > 96 && charCode < 123) ||
                (charCode > 191 && charCode <= 255) || charCode == 32
            ){
                return true;
            } else {
                return false;
            }
        } catch (err) {
            alert('Digite apenas letras no nome');
        }
    }

    function onlyNums(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            } else if (e) {
                var charCode = e.which;
            } else {
                return true;
            }
            if ((charCode >= 48 && charCode <= 57) ){
                return true;
            } else {
                return false;
            }
        } catch (err) {
            alert('Digite apenas números na matrícula');
        }
    }

    function rgLength(e, t){
        var rg = $("#rg").val().length;
        if (rg > 11) {
            $("#rg").val($("#rg").val().substring(0, $("#rg").val().length - 1));
            return false;
        }
    }

    function cpfLength(e, t){
        var cpf = $("#cpf").val().length;
        if (cpf > 11) {
            $("#cpf").val($("#cpf").val().substring(0, $("#cpf").val().length - 1));
            return false;
        }
    }
    function matriculaLength(e, t){
        var matricula = $("#matricula").val().length;
        if (matricula > 11) {
            $("#matricula").val($("#matricula").val().substring(0, $("#matricula").val().length - 1));
            return false;
        }
    }
</script>

@extends('templates.principal')

@section('title')
    Cadastrar-se
@endsection

@section('content')

<div style="border-bottom: #949494 2px solid; padding: 5px; margin-bottom: 10px">
    <h2>Cadastrar-se</h2>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                    <div class="col-md-6">
                        <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autocomplete="nome" autofocus placeHolder="Nome Completo">

                        @error('nome')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeHolder="email@exemplo.com">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                    <div class="col-md-6">
                        <input id="cpf" type="number" min="0" class="form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf" autofocus placeHolder="000.000.000-00">

                        @error('cpf')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rg" class="col-md-4 col-form-label text-md-right">{{ __('RG') }}</label>

                    <div class="col-md-6">
                        <input id="rg" type="number" min="0" class="form-control @error('rg') is-invalid @enderror" name="rg" value="{{ old('rg') }}" required autocomplete="rg" autofocus>

                        @error('rg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="data_nascimento" class="col-md-4 col-form-label text-md-right">{{ __('Data de nascimento') }}</label>

                    <div class="col-md-6">
                        <input id="data_nascimento" type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="data_nascimento" min="" max="">

                        @error('data_nascimento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="matricula" class="col-md-4 col-form-label text-md-right">{{ __('Matrícula') }}</label>

                    <div class="col-md-6">
                        <input id="matricula" type="number" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="{{ old('matricula') }}" required autocomplete="matricula" autofocus placeHolder="000000000">

                        @error('matricula')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="imagem" class="col-md-4 col-form-label text-md-right">{{ __('Imagem') }}</label>

                    <div class="col-md-6">
                        <input id="imagem" type="file" class="form-control-file @error('imagem') is-invalid @enderror" name="imagem" accept=".png, .jpg, .jpeg, .svg, .dib, .bmp">

                        @error('imagem')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Cadastrar-se') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

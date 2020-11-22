@extends('templates.principal')

@section('title')
    Redefinir Senha
@endsection

@section('content')

<div style="border-bottom: #949494 2px solid; padding: 5px; margin-bottom: 10px">
    <h2>REDEFINIR SENHA</h2>
</div>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeHolder="email@exemplo.com">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn" style="background-color: #3E3767; color: white">
                {{ __('Enviar link de redefinição de senha') }}
            </button>
        </div>
    </div>
</form>
@endsection

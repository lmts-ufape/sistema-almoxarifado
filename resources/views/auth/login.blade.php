@extends('templates.principal')

@section('title')
    Login
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm">
            <div id="carouselControls" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselControls" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselControls" data-slide-to="1"></li>
                  <li data-target="#carouselControls" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="https://placehold.it/500x500.png" class="d-block w-100" alt="placeholder1">
                  </div>
                  <div class="carousel-item">
                    <img src="https://placehold.it/500x500.png" class="d-block w-100" alt="placeholder2">
                  </div>
                  <div class="carousel-item">
                    <img src="https://placehold.it/500x500.png" class="d-block w-100" alt="placeholder3">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-sm">
            <h3 class="col-md-8 offset-md-3" style="margin-bottom: 5%; font-family: 'Segoe UI'; color: #3E3767; font"><u>Almoxarifado</u></h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group col-md-9">
                    <label for="email" class="control-label" style="font-family: 'Segoe UI'; color: #3E3767; font-weight: bold; font-size: 20px">E-mail</label>
                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" style="padding: 0; color: black; border-radius: 0; box-shadow: none; border: none; border-bottom: 1px solid" required autocomplete="email" autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-9">
                    <label for="password" class="control-label" style="font-family: 'Segoe UI'; color: #3E3767; font-weight: bold; font-size: 20px">Senha</label>
                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" style="padding: 0; color: black; border-radius: 0; box-shadow: none; border: none; border-bottom: 1px solid" required autocomplete="current-password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-control-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                    <label class="form-check-label" for="remember">
                        {{ __('Lembrar usuário/e-mail e senha') }}
                    </label>
                </div>
                <br>
                <div class="form-group col-md-9">
                    <button type="submit" class="btn btn-success btn-block">
                        {{ __('Entrar') }}
                    </button>
                </div>
                @if (Route::has('password.request'))
                    <div class="form-group col-md-9">
                        <a class=" btn-link" href="{{ route('password.request') }}">Clique aqui</a>
                        <label>se você esqueceu a senha</label>
                        <hr style="margin-top: 0">
                    </div>
                @endif
            </form>
            <div class="col-sm">
                <label for="">Clique em cadastre-se para criar uma conta</label>
            </div>
            <div class="form-group col-md-9">
                <a type="button" href="{{ route('register') }}"class="btn btn-primary btn-block">
                    {{ __('Cadastre-se') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

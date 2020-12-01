@extends('templates.principal')

@section('title')
    Editar Senha
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding: 5px; margin-bottom: 10px">
        <h2>Editar Senha</h2>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <form action="{{ route('usuario.update_senha', $usuario->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class="form-group">
                <label for="password"> Senha </label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" required>
                
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm"> Confirmar Senha </label>
                <input class="form-control" type="password" name="password_confirmation" id="password-confirm" required>
            </div>

            <div class="form-group col-md-12" class="form-row"
                 style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
            </div>

            <div class="form-row">
                <div class="col-sm-1">
                    <a href="{{ route('home') }}" class="btn btn-secondary"> Cancelar </a>
                </div>
                <div class="col-sm-1">
                    <Button class="btn btn-success" type="submit"> Atualizar </Button>
                </div>
            </div>
        </div>
    </form>
@endsection

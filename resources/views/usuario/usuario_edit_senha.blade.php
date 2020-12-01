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

            <!-- <div class="form-group">
                <h2 class="h4"> Senha </h2>
            </div> -->

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
                    <!-- <Button class="btn btn-secondary" type="button" onClick="location.href='../'"> Cancelar </Button> -->
                    <a href="{{ route('home') }}" class="btn btn-secondary"> Cancelar </a>
                </div>
                <!-- <div class="col-sm-1"> -->
                    <!-- <Button type="button" class="btn btn-danger"> Remover </Button> -->
                <!-- </div> -->
                <div class="col-sm-1">
                    <Button class="btn btn-success" type="submit"> Atualizar </Button>
                </div>
            </div>

        </div>
    </form>
@endsection

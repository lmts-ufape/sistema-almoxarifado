

@extends('../templates.principal')

@section('title')
    Editar Perfil
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>EDITAR PERFIL</h2>
    </div>

    <form action="{{ route('cargo.update', $cargo->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nome"> Nome </label>
            <input class="form-control" type="text" name="nome" id="nome" value="{{ $cargo->nome }}">
        </div>

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
    </form>

@endsection

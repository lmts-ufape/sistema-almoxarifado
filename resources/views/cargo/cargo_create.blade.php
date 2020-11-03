

@extends('../templates.principal')

@section('title')
    Cargo Create
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding: 5px; margin-bottom: 10px">
        <h2>CADASTRAR CARGO</h2>
    </div>

    <form action="{{ route('cargo.store') }}" method="POST">
    
        @csrf

        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-12" class="form-row" style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
                    <label for="nome"> Cargo </label>
                    <input class="form-control" type="text" name="nome" id="nome" placeHolder="Cargo">
                </div>   
            </div>

            <div class="form-row">
                <div class="col-sm-1">
                    <Button class="btn btn-light" type="button" onClick="location.href='../'"> Cancelar </Button>
                </div>
                <div class="col-sm-1">
                    <Button class="btn btn-success" type="submit"> Salvar </Button>
                </div>
            </div>
        </div>
    </form>

@endsection
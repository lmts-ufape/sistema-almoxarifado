@extends('templates.principal')

@section('title') Relatório Material @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding: 5px; margin-bottom: 10px">
        <h2>RELATÓRIO</h2>
    </div>

    <div>
        <form method="POST" action="{{ route('relatorio.materiais') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="data_inicio" class="col-md-2 col-form-label text-md-right">{{ __('Data de início:') }}</label>

                <div class="col-md-4">
                    <input id="data_inicio" type="date" value="{{ old('data_inicio') }}" class="form-control @error('data_inicio') is-invalid @enderror" name="data_inicio" min="1910-01-01" max="2020-12-31">

                    @error('data_inicio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="data_fim" class="col-md-2 col-form-label text-md-right">{{ __('Data de fim:') }}</label>

                <div class="col-md-4">
                    <input id="data_fim" type="date" value="{{ old('data_fim') }}" class="form-control @error('data_fim') is-invalid @enderror" name="data_fim" min="1910-01-01" max="2020-12-31">

                    @error('data_fim')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success">Gerar Relatório</button>
        </form>
    </div>
@endsection

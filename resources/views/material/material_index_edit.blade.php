@extends('templates.principal')

@section('title') Cadastrar Material @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>MATERIAIS CADASTRADOS</h2>
    </div>
    @if(session()->has('fail'))
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>{{session('fail')}}</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @elseif(session()->has('sucess'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{session('sucess')}}</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <table id="tableMateriais" class="table table-hover table-responsive-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
        <tr>
            <th class="align-middle" scope="col">Imagem</th>
            <th class="align-middle" scope="col">Material</th>
            <th class="align-middle" scope="col">Descrição</th>
            <th class="align-middle" scope="col">Qtd. Mínima</th>
            <th class="align-middle" scope="col">Código</th>
            <th class="align-middle" scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse($materials as $material)
            <tr>
                <td><img src="{{ url('storage/img/materiais/'.$material->imagem) }}" alt="{{ $material->imagem }}"
                         width="80" height="80"></td>
                <td>
                {{ $material->nome }}</th>
                <td>{{ $material->descricao }}</td>
                <td>{{ $material->quantidade_minima }}</td>
                <td>{{ $material->codigo }}</td>
                <td style="text-align: center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ⋮
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a type="button" class="dropdown-item" onclick="location.href = '{{ route('material.edit', ['material' => $material->id]) }}'">Editar</a>
                            <a type="button" class="dropdown-item" onclick="if(confirm('Tem certeza que deseja Remover o Material?')) location.href='{{route('material.destroy', $material->id)}}'">Remover</a>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <td colspan="5">Sem materiais cadastrados ainda</td>
        @endempty

        </tbody>
    </table>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/material/index.js')}}"></script>

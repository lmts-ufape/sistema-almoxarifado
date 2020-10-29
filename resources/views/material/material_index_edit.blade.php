@extends('templates.principal')

@section('title') Cadastrar Material @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>MATERIAIS CADASTRADOS</h2>
    </div>

    <table class="table table-hover">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
             <tr>
                <th scope="col">Imagem</th>
                <th scope="col">Material</th>
                <th scope="col">Descrição</th>
                <th scope="col">Quantidade minínima</th>
                <th scope="col">Código</th>
            </tr>
        </thead>
        <tbody>

            @forelse($materials as $material)
                <tr onclick="location.href = '{{ route('material.edit', ['material' => $material->id]) }}'" style="cursor: pointer;">
                    <td>.jpg</td>
                    <td>{{ $material->nome }}</th>
                    <td>{{ $material->descricao }}</td>
                    <td>{{ $material->quantidade_minima }}</td>
                    <td>{{ $material->codigo }}</td>
                </tr>
            @empty
                <td colspan="5">Sem materiais cadastrados ainda</td>
            @endempty

        </tbody>
    </table>
@endsection

@extends('templates.principal')

@section('title') Cadastrar Material @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CONSULTAR MATERIAIS</h2>
    </div>

    <table class="table table-hover">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
             <tr>
                <th scope="col">Imagem</th>
                <th scope="col">Material</th>
                <th scope="col">Descrição</th>
                <th scope="col">Qtd total</th>
                <th scope="col">Qtd minínima</th>
                <th scope="col">Código</th>
            </tr>
        </thead>
        <tbody>

            @forelse($materials as $material)
                @php
                    $quantidadeTotal = 0;
                    foreach ($estoques as $estoque) {
                        if($estoque->material_id == $material->id){
                            $quantidadeTotal += $estoque->quantidade;
                        }
                    }
                @endphp
                <tr onclick="location.href = '{{ route('material.index') }}'" style="cursor: pointer;">
                    <td>.jpg</td>
                    <td>{{ $material->nome }}</th>
                    <td>{{ $material->descricao }}</td>
                    <td>{{ $quantidadeTotal }}</td>
                    <td>{{ $material->quantidade_minima }}</td>
                    <td>{{ $material->codigo }}</td>
                </tr>
            @empty
                <td colspan="5">Sem materiais cadastrados ainda</td>
            @endempty

        </tbody>
    </table>
@endsection

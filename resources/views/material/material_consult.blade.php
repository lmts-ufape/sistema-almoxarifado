@extends('templates.principal')

@section('title') Cadastrar Material @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CONSULTAR MATERIAIS</h2>
    </div>

    <table id="tableMateriais" class="table table-hover table-responsive-md">
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
                <td> <img src="{{ url('storage/img/materiais/'.$material->imagem) }}" alt="{{ $material->imagem }}" width="80" height="80"> </td>
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tableMateriais').DataTable({
            searching: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "info": "Exibindo página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "zeroRecords": "Nenhum registro disponível",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo"
                }
            },
            "order": [],
            "columnDefs": [ {
                "targets"  : [0],
                "orderable": false
            }]
        });
    });
</script>
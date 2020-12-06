@extends('templates.principal')

@section('title') Consultar Materiais @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CONSULTAR MATERIAIS</h2>
    </div>

    <table id="tableMateriais" class="table table-hover table-responsive-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
        <tr>
            <th class="align-middle" scope="col"></th>
            <th class="align-middle" scope="col">Imagem</th>
            <th class="align-middle" scope="col">Material</th>
            <th class="align-middle" scope="col">Descrição</th>
            <th class="align-middle" scope="col">Qtd Total</th>
            <th class="align-middle" scope="col">Qtd Mínima</th>
            <th class="align-middle" scope="col">Código</th>
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
            @if($material->quantidade_minima > $quantidadeTotal)
                <!-- Cor Vermelha -->
                    <td bgcolor="E36763"></td>
            @elseif(($material->quantidade_minima + 20) > $quantidadeTotal)
                <!-- Cor Amarela -->
                    <td bgcolor="ffe680"></td>
            @else
                <!-- Cor Verde -->
                    <td bgcolor="c7f9cc"></td>
                @endif
                <td><img src="{{ url('storage/img/materiais/'.$material->imagem) }}" alt="{{ $material->imagem }}"
                         width="80" height="80"></td>
                <td>{{ $material->nome }}</td>
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
    $(document).ready(function () {
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
            "columnDefs": [{
                "targets": [0],
                "orderable": false
            }]
        });

        $('#tableMateriais').on('page.dt', function () {
            $('html, body').animate({
                scrollTop: $(".dataTables_wrapper").offset().top
            }, 'fast');
        });
    });
</script>

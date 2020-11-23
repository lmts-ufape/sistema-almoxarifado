
@extends('templates.principal')

@section('title')
    Usuario
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>USUÁRIOS CADASTRADOS</h2>
    </div>

    <table id="tableUsuarios" class="table table-hover table-responsove-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
            <tr>
                <th scope="col"> Imagem </th>
                <th scope="col"> Nome </th>
                <th scope="col"> Email </th>
                <th scope="col"> Cargo </th>
            </tr>
        </thead>

        <tbody>
        @forelse($usuarios as $usuario)
                <tr onclick="location.href = '{{ route('usuario.edit', ['usuario' => $usuario->id]) }}'" style="cursor: pointer;">
                <td> <img src="{{ url('storage/img/usuarios/'.$usuario->imagem) }}" alt="{{ $usuario->imagem }}" width="80" height="80"></td>
                <td>{{ $usuario->nome }}</th>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->getCargo($usuario->cargo_id)->nome }}</td>
            </tr>
        @empty
            <td colspan="5">Sem usuários cadastrados ainda</td>
        @endempty
        </tbody>
    </table>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tableUsuarios').DataTable({
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
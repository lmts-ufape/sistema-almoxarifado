
@extends('templates.principal')

@section('title') Depositos @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CONSULTAR DEPÓSITOS</h2>
    </div>

    <div  style="float: right">
        <span style="font-weight: bold">Selecione um depósito:</span>
        <select name="selectDeposito" id="selectDeposito">
            <option selected hidden>Escolher depósito</option>
            @foreach($depositos as $d)
                <option value="{{ $d->id }}">{{ $d->id }}. {{$d->nome}} </option>
            @endforeach
        </select>
    </div>

    <table id="tableDepositos" class="table table-hover table-responsive-md" >
        <thead style="background-color: #151631; color: white; border-radius: 15px">
             <tr>
                <th scope="col">Material</th>
                <th scope="col" style="text-align: center">Quantidade</th>
            </tr>
        </thead>
        <tbody id="listaEstoque"></tbody>
    </table>

@endsection
@section('post-script')
    <script type="text/javascript">
        $('select[name=selectDeposito]').change(function (){
            var deposito_id = $(this).val();

            $.get('/get_estoques/' + deposito_id, function (estoques) {
                $('#listaEstoque').empty();
                $.each(estoques, function (key, value) {
                    $('#listaEstoque').append(`<tr><td>${value.nome}</td><td style=\"text-align: center\">${value.quantidade}</td></tr>`);
                });
            });
        });

    </script>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tableDepositos').DataTable({
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
                "targets"  : [0,1],
                "orderable": false
            }]
        });
    });
</script>

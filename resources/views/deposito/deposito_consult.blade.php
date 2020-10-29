
@extends('templates.principal')

@section('title') Depositos @endsection

@section('content')
    <h2>CONSULTAR DEPÓSITOS</h2>

    <label>Lista de Depositos:</label>

    </br>

    <select name="selectDeposito">
        <option>Depositos</option>
        @foreach($depositos as $d)
            <option value="{{ $d->id }}"> {{$d->nome}} </option>
        @endforeach
    </select>

    <ul id="listaEstoque">

    </ul>
@endsection
@section('post-script')
    <script type="text/javascript">
        $('select[name=selectDeposito]').change(function (){
            var deposito_id = $(this).val();

            $.get('/get_estoques/' + deposito_id, function (estoques) {
                $('#listaEstoque').empty();
                $.each(estoques, function (key, value) {
                    $('#listaEstoque').append('<li><b>Material: </b>' + value.material_id + ' | <b>Quantidade:</b> ' + value.quantidade + '</li>');
                });
            });
        });

    </script>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

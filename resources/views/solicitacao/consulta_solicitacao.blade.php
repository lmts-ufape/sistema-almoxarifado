
@extends('templates.principal')

@section('title') Consultar Solicitações @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CONSULTAR SOLICITAÇÃO</h2>
    </div>

    <table id="tableSolicitacoes" class="table table-hover" style="margin-top: 10px;">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Requerente</th>
                <th scope="col">Material</th>
                <th scope="col">Situação</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($status); $i++)
                <tr>
                    <td>{{ $status[$i]->solicitacao_id }}</td>
                    <td>{{ Auth::user()->nome }}</td>
                    <td><a type="button" class="showDetails" data-id="{{ $status[$i]->solicitacao_id }}">Abrir</a></td>
                    <td>{{ $status[$i]->status }}</td>
                    <td>{{ date('d/m/Y',  strtotime($status[$i]->created_at))}}</td>
                </tr>
            @endfor
        </tbody>
    </table>

    <div class="modal fade" id="detalhesSolicitacao" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel" style="color:#151631">Solicitação - <span id="numSolicitacao"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="overlay">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" style="width: 5rem; height: 5rem" role="status"></div>
                    </div>
                </div>
                <table id="tableItens" class="table table-hover" style="margin-top: 10px; display: none">
                    <thead style="background-color: #151631; color: white; border-radius: 15px">
                        <tr>
                            <th scope="col">Material</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Qtd. Solicitada</th>
                            <th scope="col">Qtd. Aprovada</th>
                        </tr>
                    </thead>
                    <tbody id="listaItens"></tbody>
                </table>
                <div id="observacao" style="display: none">
                    <label for="inputObservacao">Observações</label>
                    <textarea class="form-control" name="observacao" id="inputObservacao" cols="30" rows="3" readonly></textarea>
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script>

    $(document).ready(function () {
        $(".showDetails").click(function (e) {
            e.preventDefault();

            $("#overlay").show();

            var id = $(this).data('id');

            $("#detalhesSolicitacao").modal('show');

            $('#numSolicitacao').text(id);

            $.ajax({
                url: '/observacao_solicitacao/' + id,
                type: 'GET',
                dataType: 'json',
                success : function(data){
                    $('#inputObservacao').text(data[0]['observacao']);
                }
            })

            $.ajax({
                url: '/itens_solicitacao/' + id,
                type: 'GET',
                dataType: 'json',
                success : function(data){
                    var ret = '';
                    for(var item in data){
                        ret += "<tr>";
                        ret += "<td>" + data[item]['nome'] + "</td>";
                        ret += "<td>" + data[item]['descricao'] + "</td>";
                        ret += "<td>" + data[item]['quantidade_solicitada'] + "</td>";
                        ret += "<td>" + (data[item]['quantidade_aprovada'] == null ? '' : data[item]['quantidade_aprovada']) + "</td>";
                        ret += "</tr>";
                    }

                    $("#tableItens tbody").append(ret);
                    $("#overlay").hide();
                    $("#tableItens").show();
                    $("#observacao").show();
                }
            })
        });

        $('#detalhesSolicitacao').on('hidden.bs.modal', function (e) {
            $("#tableItens").hide();
            $("#observacao").hide();
            $("#listaItens").empty();
        });
    });
</script>

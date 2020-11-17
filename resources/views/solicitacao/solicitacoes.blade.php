
@extends('templates.principal')

@section('title') Aprovar Solicitações @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>APROVAR SOLICITAÇÕES</h2>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

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
            @if (count($requerentes) > 0 && count($solicitacoes) > 0 && count($status) > 0)
                @for ($b = 0; $b < count($requerentes); $b++)
                    @for ($i = 0; $i < count($solicitacoes); $i++)
                        <tr>
                            <td>{{ $solicitacoes[$i]->id }}</td>
                            <td>{{ $requerentes[$b]->nome }}</td>
                            <td><a type="button" class="showDetails" data-id="{{ $solicitacoes[$i]->id }}">Abrir</a></td>
                            <td>{{ $status[$i]->status }}</td>
                            <td>{{ date('d/m/Y',  strtotime($status[$i]->created_at))}}</td>
                        </tr>
                    @endfor
                @endfor
            @endif
        </tbody>
    </table>

    <form method="POST" id="formSolicitacao" name="formSolicitacao" action="{{ route('aprovar.solicitacao') }}">
        @csrf
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
                        <label for="observacaoRequerente">Observações do requerente</label>
                        <textarea class="form-control" id="observacaoRequerente" cols="30" rows="3" readonly></textarea>
                    </div>
                    <div id="observacaoAdmin" style="display: none; margin-top: 10px">
                        <label for="inputObservacao">Suas observações</label>
                        <textarea class="form-control" name="observacao" id="inputObservacao" cols="30" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="solicitacaoID" name="solicitacaoID" value="">

                    <button id="negaSolicitacao" style="display: none" name="action" type="submit" class="btn btn-danger" value="nega">Negar</button>
                    <button id="aprovaSolicitacao" style="display: none" name="action" type="submit" class="btn btn-success" value="aprova">Aprovar</button>
                </div>
              </div>
            </div>
        </div>
    </form>
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
                    $('#observacaoRequerente').text(data[0]['observacao']);
                }
            })

            $.ajax({
                url: '/observacao_status/' + id,
                type: 'GET',
                dataType: 'json',
                success : function(data){
                    $('#inputObservacao').text(data[0]['observacao']);
                }
            })

            $.ajax({
                url: '/itens_solicitacao_admin/' + id,
                type: 'GET',
                dataType: 'json',
                success : function(data){
                    var ret = '';
                    for(var item in data){
                        ret += "<tr>";
                        ret += "<td>" + data[item]['nome'] + "</td>";
                        ret += "<td>" + data[item]['descricao'] + "</td>";
                        ret += "<td>" + data[item]['quantidade_solicitada'] + "</td>";
                        ret += "<td>" + '<input type=\"number\" id=\"inputQuantAprovada\" name=\"quantAprovada[]\" value=\"' + data[item]['quantidade_aprovada'] + '\">' + "</td>";
                        ret += "</tr>";
                    }

                    $('#solicitacaoID').val(id);
                    $("#tableItens tbody").append(ret);
                    $("#overlay").hide();
                    $("#tableItens").show();
                    $("#observacao").show();
                    $("#observacaoAdmin").show();
                    $('#negaSolicitacao').show();
                    $('#aprovaSolicitacao').show();
                }
            })
        });

        $('#detalhesSolicitacao').on('hidden.bs.modal', function (e) {
            $('#solicitacaoID').val(0);
            $("#tableItens").hide();
            $("#observacao").hide();
            $("#observacaoAdmin").hide();
            $('#negaSolicitacao').hide();
            $('#aprovaSolicitacao').hide();
            $('#negaSolicitacao').hide();
            $('#aprovaSolicitacao').hide();
            $("#listaItens").empty();
        });
    });
</script>

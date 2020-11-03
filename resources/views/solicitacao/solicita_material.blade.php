
@extends('templates.principal')

@section('title') Solicitações @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>SOLICITAR MATERIAL</h2>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div style="background-color: #949494">
        <div class="form-row" style="margin-left: 10px">
            <div class="form-group col-md-4">
                <label for="inputMaterial" style="color: #151631; font-family: 'Segoe UI'; font-weight: 700">Material</label>
                <select id="inputMaterial" class="form-control" name="material_id">
                    <option selected hidden>Escolher...</option>
                    @foreach($materiais as $material)
                        <option id="optionSelected" value="{{$material->id}}"> {{$material->id}}.{{ $material->nome }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputQuantidade" style="color: #151631; font-family: 'Segoe UI'; font-weight: 700">Quantidade</label>
                <input type="number" class="form-control" id="inputQuantidade" name="quantidade" value="{{ old('quantidade') }}">
            </div>

            <div class="form-group col-md-3">
                <label for="inputReceptor" style="color: #151631; font-family: 'Segoe UI'; font-weight: 700">Receptor</label>
                <input type="text" class="form-control" id="inputReceptor" name="receptor" value="{{ old('receptor') }}">
            </div>
        </div>
        <button id="addTable"  class="btn btn-primary" style="margin: 10px" onclick="addTable()">Adicionar</button>
    </div>

    <div id="error" class="alert alert-danger" role="alert" style="margin-top: 10px; display: none">
        Informe o material, a quantidade e o receptor.
    </div>

    <form method="POST" id="formSolicitacao" name="formSolicitacao" action="{{ route('solicita.store') }}">
        @csrf
        <table id="tableMaterial" class="table table-hover" style="margin-top: 10px;">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
                <tr>
                    <th scope="col">Material</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Receptor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="form-group col-md-12" class="form-row" style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
            <label for="inputObservacao">Observações</label>
            <textarea class="form-control" name="observacao" id="inputObservacao" cols="30" rows="3">{{ old('observacao') }}</textarea>
        </div>

        <input type="hidden" id="dataTableMaterial" name="dataTableMaterial" value="">
        <input type="hidden" id="dataTableQuantidade" name="dataTableQuantidade" value="">
        <input type="hidden" id="dataTableReceptor" name="dataTableReceptor" value="">
        
        <button id="solicita" class="btn btn-success" disabled onclick="setValuesRowInput()">Solicitar</button>
    </form>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script>
    var _row = null;
    var nomeMaterial = null;

    function setValuesRowInput(){
        var materiais = [];
        var quantidades = [];
        var receptores = [];

        $("#tableMaterial > tbody > tr").children('.materialRow').each(function() {
            materiais.push($(this).text().split(".")[0]);
        });

        $("#tableMaterial > tbody > tr").children('.quantidadeRow').each(function() {
            quantidades.push($(this).text());
        });

        $("#tableMaterial > tbody > tr").children('.receptorRow').each(function() {
            receptores.push($(this).text());
        });

        $('#dataTableMaterial').val([materiais]);
        $('#dataTableQuantidade').val([quantidades]);
        $('#dataTableReceptor').val([receptores]);
    }

    function construirTable(quantidade, receptor){
        return "<td class=\"quantidadeRow\">" + quantidade + "</td>" +
        "<td class=\"receptorRow\">" + receptor + "</td>" +
        "<td>" +
            "<div class=\"dropdown\">" +
                "<button class=\"btn btn-secondary dropdown\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">" +
                    ":" +
                "</button>" +
                "<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">" +
                    "<a type=\"button\" class=\"dropdown-item\" onclick=\"deleteRow(this)\">Remover</a>" +
                    "<a type=\"button\" class=\"dropdown-item\" onclick=\"showData(this)\">Editar</a>" +
                "</div>" +
            "</div>" +
        "</td>" +
        "</tr>";
    }

    function addTable() {

        if ($("#addTable").text() == "Atualizar") {
            if($("#inputQuantidade").val() != '' &&  !(/^0*$/.test($("#inputQuantidade").val())) 
                && $("#inputReceptor").val() != ''){
                updateRowTable();
            } else {
                $('#error').slideDown();
                setTimeout(function() { 
                    $('#error').slideUp(); 
                }, 5000);
            }
        } else {
            if ($("#inputMaterial").val() != 'Escolher...' && $("#inputQuantidade").val() != '' &&
                    !(/^0*$/.test($("#inputQuantidade").val())) && $("#inputReceptor").val() != '') {
                addRowTable();
            } else {
                $('#error').slideDown();
                setTimeout(function() { 
                    $('#error').slideUp(); 
                }, 5000);
            }
        }
        clearFields();

        if ($("#tableMaterial >tbody >tr").length > 0) {
            $("#solicita").attr("disabled", false);
        }
    }

    function addRowTable() {
        $("#tableMaterial tbody").append("<tr>" +
            "<td class=\"materialRow\">" + $("#inputMaterial option:selected").text()+ "</td>" + 
            construirTable($("#inputQuantidade").val(), $("#inputReceptor").val()));
    }

    function updateRowTable() {
        $(_row).after(refactorRowtable());
        
        $(_row).remove();
        
        clearFields();
        
        $("#addTable").text("Adicionar");
    }

    function refactorRowtable() {
        var ret = "<tr>" +
            "<td class=\"materialRow\">" + nomeMaterial + "</td>" + construirTable($("#inputQuantidade").val(), $("#inputReceptor").val());
        
        nomeMaterial = null;
        return ret;
    }

    function clearFields() {
        $("#inputMaterial").val($("#inputMaterial option:first").val());
        $("#inputQuantidade").val("");
        $("#inputReceptor").val("");
    }

    function showData(ctl) {
        _row = $(ctl).parents("tr");
        var cols = _row.children("td");
        nomeMaterial = $(cols[0]).text();
        $("#inputQuantidade").val($(cols[1]).text());
        $("#inputReceptor").val($(cols[2]).text());
        
        $("#addTable").text("Atualizar");
    }

    function deleteRow(ctl) {
        $(ctl).parents("tr").remove();

        if ($("#tableMaterial >tbody >tr").length == 0) {
            $("#solicita").attr("disabled", true);
        }
    }
</script>

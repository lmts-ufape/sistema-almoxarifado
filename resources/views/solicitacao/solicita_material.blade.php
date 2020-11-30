
@extends('templates.principal')

@section('title') Solicitar Material @endsection

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

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

    <div id="error" class="alert alert-danger" role="alert" style="margin-top: 10px; display: none">
        Informe o material e a quantidade!
    </div>

    <div id="remocaoSuccess" class="alert alert-success" role="alert" style="margin-top: 10px; display: none">
        Material removido! 
    </div>

    <div id="editSuccess" class="alert alert-success" role="alert" style="margin-top: 10px; display: none">
        Material Editado!
    </div>

    <div style="background-color: #D7D7E6">
        <div class="form-row" style="margin-left: 10px">
            <div class="form-group col-md-4">
                <label for="selectMaterial" style="color: #151631; font-family: 'Segoe UI'; font-weight: 700">Material</label>
                <select id="selectMaterial" class="selectMaterial" class="form-control" style="width: 95%;">
                    <option></option>
                    @foreach($materiais as $material)
                        <option data-value="{{$material->id}}"> {{$material->codigo}} - {{ $material->nome }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputQuantidade" style="color: #151631; font-family: 'Segoe UI'; font-weight: 700">Quantidade</label>
                <input type="number" min="1" onkeypress="return onlyNumsQtd(event,this);" class="form-control" id="inputQuantidade" name="quantidade" value="{{ old('quantidade') }}">
            </div>
            <div class="form-group">
                <button id="addTable" style="margin-top: 30px; margin-left: 10px" class="btn btn-primary" onclick="addTable()">Adicionar</button>
            </div>
        </div>
    </div>

    <form method="POST" id="formSolicitacao" name="formSolicitacao" action="{{ route('solicita.store') }}">
        @csrf
        <table id="tableMaterial" class="table table-hover table-responsive-md" style="margin-top: 10px">
            <thead style="background-color: #151631; color: white; border-radius: 15px">
                <tr>
                    <th scope="col">Material</th>
                    <th scope="col" style="text-align: center">Quantidade</th>
                    <th scope="col" style="text-align: center">Ações</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <label style="margin-top: 10px"><strong>Receptor</strong></label>
        <div class="form-row" style="padding: 0 0 0 0;">
            <div class="form-group col-md-4">
                <div class="form-group">
                    <label for="inputNomeReceptor">Nome</label>
                    <input type="text" class="form-control" id="inputNomeReceptor" onkeypress="return onlyLetters(event,this);" maxlength="100" name="nomeReceptor" value="" disabled="true">
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="inputRgReceptor">RG</label>
                <input type="number" min="1" onkeypress="return onlyNums(event,this);" oninput="return rgLength();" class="form-control" id="inputRgReceptor" name="rgReceptor" value="" disabled="true">
            </div>
        </div>
        <div class="form-check" style="margin-bottom: 10px">
            <input type="checkbox" class="form-check-input" id="checkReceptor" name="checkReceptor" checked>
            <label class="form-check-label" for="checkReceptor">Eu sou o receptor</label>
        </div>
        <div class="form-group col-md-12" class="form-row" style="border-bottom: #cfc5c5 1px solid; padding: 0 0 20px 0; margin-bottom: 20px">
            <label for="inputObservacao"><strong>Observações:</strong></label>
            <textarea class="form-control" name="observacao" id="inputObservacao" cols="30" rows="3">{{ old('observacao') }}</textarea>
        </div>

        <input type="hidden" id="dataTableMaterial" name="dataTableMaterial" value="">
        <input type="hidden" id="dataTableQuantidade" name="dataTableQuantidade" value="">
        
        <button id="solicita" class="btn btn-success" disabled onclick="return setValuesRowInput()">Solicitar</button>
    </form>

    <div class="modal fade" id="detalhesSolicitacao" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel" style="color:#151631">Editar Solicitação</span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="modalBody">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="selectMaterialEdit" style="color: #151631; font-family: 'Segoe UI'; font-weight: 700;">Material</label>
                            <select id="selectMaterialEdit" style="width: 110%;" class="selectMaterial" class="form-control" name="selectMaterialEdit">
                                <option></option>
                                @foreach($materiais as $material)
                                    <option value="{{$material->id}}"> {{$material->codigo}} - {{ $material->nome }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2" style="margin-left: 4%">
                            <label for="InputQuantEdit" style="color: #151631; font-family: 'Segoe UI'; font-weight: 700">Quantidade</label>
                            <input type="number" min="1" onkeypress="return onlyNumsQtd(event,this);" class="form-control" id="InputQuantEdit" name="InputQuantEdit" value="{{ old('quantidade') }}">
                        </div>
                        <div class="form-group">
                            <button id="updateMaterial" style="margin-top: 30px; margin-left: 10px" class="btn btn-primary" onclick="confirmarAlteracao()">Atualizar</button>
                        </div>
                    </div>
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

        $('.selectMaterial').select2({
            placeholder: "Digite algo ou selecione uma opção."
        });

        $('#checkReceptor').change(function() {
            if($(this).prop('checked')){
                $("#inputNomeReceptor").prop('disabled', true);
                $("#inputRgReceptor").prop('disabled', true);
            } else {
                $("#inputNomeReceptor").prop('disabled', false);
                $("#inputRgReceptor").prop('disabled', false);
            }
        });
    });

    var _row = null;

    function rgLength(e, t){
        var rg = $("#inputRgReceptor").val().length;
        if (rg > 11) {
            $("#inputRgReceptor").val($("#inputRgReceptor").val().substring(0, $("#inputRgReceptor").val().length - 1));
            return false;
        }
    }

    function onlyLetters(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            } else if (e) {
                var charCode = e.which;
            } else {
                return true;
            }
            if (
                (charCode > 64 && charCode < 91) || 
                (charCode > 96 && charCode < 123) ||
                (charCode > 191 && charCode <= 255) || charCode == 32
            ){
                return true;
            } else {
                return false;
            }
        } catch (err) {
            alert('Digite apenas letras no nome');
        }
    }

    function onlyNums(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            } else if (e) {
                var charCode = e.which;
            } else {
                return true;
            }
            if ((charCode >= 48 && charCode <= 57) ){
                return true;
            } else {
                return false;
            }
        } catch (err) {
            alert('Digite apenas números no RG');
        }
    }

    function onlyNumsQtd(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            } else if (e) {
                var charCode = e.which;
            } else {
                return true;
            }
            if ((charCode >= 48 && charCode <= 57) ){
                return true;
            } else {
                return false;
            }
        } catch (err) {
            alert('Digite apenas números');
        }
    }

    function construirTable(quantidade){
        return "<td class=\"quantidadeRow\" style=\"text-align: center\">" + quantidade + "</td>" +
        "<td style=\"text-align: center\">" +
            "<div class=\"dropdown\">" +
                "<button class=\"btn btn-secondary dropdown\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">" +
                    "⋮" +
                "</button>" +
                "<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">" +
                    "<a type=\"button\" class=\"dropdown-item\" onclick=\"removerMaterial(this)\">Remover</a>" +
                    "<a type=\"button\" class=\"dropdown-item\" onclick=\"editarMaterial(this)\">Editar</a>" +
                "</div>" +
            "</div>" +
        "</td>" +
        "</tr>";
    }

    function editarMaterial(ctl){
        $("#detalhesSolicitacao").modal('show');
        _row = $(ctl).parents("tr");
        var dados = $(ctl).parents("tr").children("td");
        $("#selectMaterialEdit").val($(dados[0]).data('id')).trigger('change');
        $("#InputQuantEdit").val($(dados[1]).text());
    }

    function confirmarAlteracao(){

        if ($("#selectMaterialEdit option:selected").index() > 0 && $("#InputQuantEdit").val() != '') {
            var escolha = confirm("Tem certeza que deseja fazer as alterações");
            if (escolha) {
                updateRowTable();
                $("#detalhesSolicitacao").modal('hide');
                $("#selectMaterial").val(0).trigger('change');
                $("#InputQuantEdit").val();
            }
        } else {
            alert('Informe o material e a quantidade');
        }
    }

    function removerMaterial(ctl){
        var escolha = confirm("Tem certeza que deseja remover o(s) material(is)?");
        if (escolha) {
            deleteRow(ctl);
            $('#remocaoSuccess').slideDown();
                setTimeout(function() { 
                    $('#remocaoSuccess').slideUp(); 
            }, 4000);
        }
    }

    function updateRowTable() {
        $(_row).after(refactorRowtable());
        $(_row).remove();
        clearFields();
        $('#editSuccess').slideDown();
                setTimeout(function() { 
                    $('#editSuccess').slideUp(); 
            }, 4000);
    }

    function refactorRowtable() {
        var ret = "<tr data-id="+ $("#selectMaterialEdit option:selected").val() +  ">" +
            "<td data-id=" + $("#selectMaterialEdit option:selected").index() + " class=\"materialRow\">" + $("#selectMaterialEdit option:selected").text() + "</td>" + construirTable($("#InputQuantEdit").val());
        return ret;
    }

    function clearFields() {
        $("#selectMaterial").val("").trigger('change');
        $("#inputQuantidade").val("");
    }

    function deleteRow(ctl) {
        $(ctl).parents("tr").remove();

        if ($("#tableMaterial >tbody >tr").length == 0) {
            $("#solicita").attr("disabled", true);
        }
    }

    function setValuesRowInput(){
        var materiais = [];
        var quantidades = [];

        var escolha = confirm("Tem certeza que deseja fazer uma solicitação?");
        if(escolha){
            if(!$('#checkReceptor').prop('checked')){
                var rg = $("#inputRgReceptor").val().length;
                if (rg < 7) {
                    alert('O RG não pode ter menos de 7 dígitos e mais de 11');
                    return false;
                } else if($("#inputNomeReceptor").val().length < 5 ) {
                    alert('O nome deve ter pelo menos 5 letras');
                    return false;
                }
            }
        } else {
            return false;
        }

        $("#tableMaterial > tbody > tr").children('.materialRow').each(function() {
            materiais.push($(this).data('id'));
        });

        $("#tableMaterial > tbody > tr").children('.quantidadeRow').each(function() {
            quantidades.push($(this).text());
        });

        $('#dataTableMaterial').val([materiais]);
        $('#dataTableQuantidade').val([quantidades]);
    }

    function addTable() {
        if ($("#selectMaterial option:selected").index() > 0 && $("#inputQuantidade").val() != '') {
            $("#tableMaterial tbody").append("<tr data-id="+ $("#selectMaterial option:selected").data('value') +  ">" +
                "<td data-id=" + $("#selectMaterial option:selected").index() + " class=\"materialRow\">" + $("#selectMaterial option:selected").text()+ "</td>" + 
                construirTable($("#inputQuantidade").val()));
        } else {
            $('#error').slideDown();
            setTimeout(function() { 
                $('#error').slideUp(); 
            }, 5000);
        }
        clearFields();

        if ($("#tableMaterial >tbody >tr").length > 0) {
            $("#solicita").attr("disabled", false);
        }
    }
</script>

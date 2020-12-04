
$(function () {
    $('.selectMaterial').select2({
        placeholder: "Digite algo ou selecione uma opção."
    });

    $('#checkReceptor').change(function () {
        if ($(this).prop('checked')) {
            $("#inputNomeReceptor").prop('disabled', true);
            $("#inputNomeReceptor").val($("#nomeReceptor").val())
            $("#inputRgReceptor").prop('disabled', true);
            $("#inputRgReceptor").val($("#rgReceptor").val())
        } else {
            $("#inputNomeReceptor").prop('disabled', false);
            $("#inputNomeReceptor").val('')
            $("#inputRgReceptor").prop('disabled', false);
            $("#inputRgReceptor").val('')
        }
    });
});

var _row = null;

function rgLength(e, t) {
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
        ) {
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
        if ((charCode >= 48 && charCode <= 57)) {
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
        if ((charCode >= 48 && charCode <= 57)) {
            return true;
        } else {
            return false;
        }
    } catch (err) {
        alert('Digite apenas números');
    }
}

function construirTable(quantidade) {
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

function editarMaterial(ctl) {
    $("#detalhesSolicitacao").modal('show');
    _row = $(ctl).parents("tr");
    var dados = $(ctl).parents("tr").children("td");
    $("#selectMaterialEdit").val($(dados[0]).data('id')).trigger('change');
    $("#InputQuantEdit").val($(dados[1]).text());
}

function confirmarAlteracao() {

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

function removerMaterial(ctl) {
    var escolha = confirm("Tem certeza que deseja remover o(s) material(is)?");
    if (escolha) {
        deleteRow(ctl);
        $('#remocaoSuccess').slideDown();
        setTimeout(function () {
            $('#remocaoSuccess').slideUp();
        }, 4000);
    }
}

function updateRowTable() {
    $(_row).after(refactorRowtable());
    $(_row).remove();
    clearFields();
    $('#editSuccess').slideDown();
    setTimeout(function () {
        $('#editSuccess').slideUp();
    }, 4000);
}

function refactorRowtable() {
    var ret = "<tr data-id=" + $("#selectMaterialEdit option:selected").val() + ">" +
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

function setValuesRowInput() {
    var materiais = [];
    var quantidades = [];

    var escolha = confirm("Tem certeza que deseja fazer uma solicitação?");
    if (escolha) {
        if (!$('#checkReceptor').prop('checked')) {
            var rg = $("#inputRgReceptor").val().length;
            if (rg < 7) {
                alert('O RG não pode ter menos de 7 dígitos e mais de 11');
                return false;
            } else if ($("#inputNomeReceptor").val().length < 5) {
                alert('O nome deve ter pelo menos 5 letras');
                return false;
            }
        }
    } else {
        return false;
    }

    $("#tableMaterial > tbody > tr").children('.materialRow').each(function () {
        materiais.push($(this).data('id'));
    });

    $("#tableMaterial > tbody > tr").children('.quantidadeRow').each(function () {
        quantidades.push($(this).text());
    });

    $('#dataTableMaterial').val([materiais]);
    $('#dataTableQuantidade').val([quantidades]);
}

function addTable() {
    if ($("#selectMaterial option:selected").index() > 0 && $("#inputQuantidade").val() != '') {
        $("#tableMaterial tbody").append("<tr data-id=" + $("#selectMaterial option:selected").data('value') + ">" +
            "<td data-id=" + $("#selectMaterial option:selected").index() + " class=\"materialRow\">" + $("#selectMaterial option:selected").text() + "</td>" +
            construirTable($("#inputQuantidade").val()));
    } else {
        $('#error').slideDown();
        setTimeout(function () {
            $('#error').slideUp();
        }, 5000);
    }
    clearFields();

    if ($("#tableMaterial >tbody >tr").length > 0) {
        $("#solicita").attr("disabled", false);
    }
}

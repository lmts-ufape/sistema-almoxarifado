$(function () {
    $('#email').on('input propertychange', function () {
            $('#atualizar').prop('disabled', false);
    });
    $('#numTel').on('input propertychange', function () {
        $('#atualizar').prop('disabled', false);
    });
    $('#rg').on('input propertychange', function () {
        $('#atualizar').prop('disabled', false);
    });
    $('#cpf').on('input propertychange', function () {
        $('#atualizar').prop('disabled', false);
    });
    $('#data_nascimento').on('input propertychange', function () {
        $('#atualizar').prop('disabled', false);
    });
    $('#cargo').on('input propertychange', function () {
        $('#atualizar').prop('disabled', false);
    });
    $('#matricula').on('input propertychange', function () {
        $('#atualizar').prop('disabled', false);
    });
    $('#setor').on('input propertychange', function () {
        $('#atualizar').prop('disabled', false);
    });
    $('#nome').on('input propertychange', function () {
        $('#atualizar').prop('disabled', false);
    });

    document.getElementById('data_nascimento').max = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000).toISOString().split("T")[0];
});

function rgLength() {
    let rg = $("#rg").val().length;
    if (rg > 11) {
        $("#rg").val($("#rg").val().substring(0, $("#rg").val().length - 1));
        return false;
    }
}

function cpfLength() {
    let cpf = $("#cpf").val().length;
    if (cpf > 11) {
        $("#cpf").val($("#cpf").val().substring(0, $("#cpf").val().length - 1));
        return false;
    }
}

function numTelLength() {
    let numTel = $("#numTel").val().length;
    if (numTel > 11) {
        $("#numTel").val($("#numTel").val().substring(0, $("#numTel").val().length - 1));
        return false;
    }
}

function matriculaLength(){
    let matricula = $("#matricula").val().length;
    if (matricula > 11) {
        $("#matricula").val($("#matricula").val().substring(0, $("#matricula").val().length - 1));
        return false;
    }
}
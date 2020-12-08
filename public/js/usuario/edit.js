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
    $('#nome').on('input propertychange', function () {
        $('#atualizar').prop('disabled', false);
    });
});

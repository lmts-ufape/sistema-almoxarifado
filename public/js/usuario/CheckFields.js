$(function () {
    document.getElementById('data_nascimento').max = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000).toISOString().split("T")[0];

    $("#nome").mask("#", {
        maxlength: true,
        translation: {
            '#': { pattern: /^[A-Za-záâãéêíóôõúçÁÂÃÉÊÍÓÔÕÚÇ\s]+$/, recursive: true }
        }
    });

    $('#cpf').mask('000.000.000-00');

    $('#numTel').mask('(00)00000-0000');

    $("#rg").mask("#", {
        maxlength: true,
        translation: {
            '#': { pattern: /[0-9]/, recursive: true }
        }
    });

    $("#matricula").mask("#", {
        maxlength: true,
        translation: {
            '#': { pattern: /[0-9]/, recursive: true }
        }
    });
})
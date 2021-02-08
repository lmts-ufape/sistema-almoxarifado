$(function () {
    $("#nomeDeposito").mask("#", {
        maxlength: true,
        translation: {
            '#': { pattern: /^[A-Za-záâãéêíóôõúçÁÂÃÉÊÍÓÔÕÚÇ\s]+$/, recursive: true }
        }
    });

    $("#depositoCodigo").mask("#", {
        maxlength: true,
        translation: {
            '#': { pattern: /^[0-9\s]+$/, recursive: true }
        }
    });
})
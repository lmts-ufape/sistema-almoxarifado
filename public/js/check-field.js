
$(document).ready(function(){

    $("#nome").mask("#", {
        maxlength: false,
        translation: {
            '#': {pattern: /[A-zÀ-ÿ ]/, recursive: true}
        }
    });
    
    $('#cpf').mask('00000000000'); 

    $('#rg').mask('00000000000');

});

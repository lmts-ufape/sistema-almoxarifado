
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
        alert('Digite apenas letras');
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
        alert('Digite apenas números');
    }
}

function rgLength() {
    var rg = $("#rg").val().length;
    if (rg > 11) {
        $("#rg").val($("#rg").val().substring(0, $("#rg").val().length - 1));
        return false;
    }
}

function cpfLength() {
    var rg = $("#cpf").val().length;
    if (rg > 11) {
        $("#cpf").val($("#cpf").val().substring(0, $("#cpf").val().length - 1));
        return false;
    }
}

function numTelLength() {
    var rg = $("#numTel").val().length;
    if (rg > 11) {
        $("#numTel").val($("#numTel").val().substring(0, $("#numTel").val().length - 1));
        return false;
    }
}

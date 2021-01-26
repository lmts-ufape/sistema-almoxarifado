function onlyLetters() {
    try {
        var letters = /^[A-Za-záâãéêíóôõúçÁÂÃÉÊÍÓÔÕÚÇ\s]+$/;
        if (window.event.key.match(letters)) {
            return true;
        }
        else {
            return false;
        }
    } catch (err) {
        alert('Digite apenas letras');
    }
}

function onlyNums() {
    try {
        let letter = window.event.key;

        if (!isNaN(parseInt(letter))) {
            return true
        } else {
            return false
        }
    } catch (err) {
        alert('Digite apenas números');
    }
}
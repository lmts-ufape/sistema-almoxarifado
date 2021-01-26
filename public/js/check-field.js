
$("#nome").mask("#", {
    maxlength: false,
    translation: {
        '#': {pattern: /[A-zÀ-ÿ ]/, recursive: true}
    }
});
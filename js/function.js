function showError(input, texto) {
    $(input).addClass('is-invalid');
    $(input).parents('.form-group').append('<div class="input-error">' + texto + '</div>');
}

function hideAllErrors() {
    $('input').removeClass('is-invalid');
    $('.input-error').remove();
    $('select').removeClass('is-invalid');
    $('.input-error').remove();
    $('textarea').removeClass('is-invalid');
    $('.input-error').remove();
}
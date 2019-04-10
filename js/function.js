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

$('.js-entero').bind('keydown keypress keyup paste input', function () {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
    var int_num_allow = 15;
    var float_num_allow = 3;
    var iof = $(this).val().indexOf(".");
    if (iof != -1) {
        if ($(this).val().substring(0, iof).length > int_num_allow) {
            $(this).val('');
        }
        $(this).val($(this).val().substring(0, iof + float_num_allow + 1));
    } else {
        $(this).val($(this).val().substring(0, int_num_allow));
    }
    return true;
});
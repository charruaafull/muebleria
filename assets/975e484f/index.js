$(function () {
    $('[name=login]').addClass('active');

    $('#btn-login').click(function () {
        frm = $('#frm-login').serialize();
        $.ajax({
            url: 'AjaxValidaLogin',
            type: 'get',
            dataType: 'json',
            data: frm,
            success: function (data) {
                if (data.error) {
                    hideAllErrors();
                    k = Object.keys(data.info)[0];
                    showError("#" + k, data.info[k]);
                    $('#' + k).focus();
                } else {
                    window.location.assign("./");
                }
            }
        });
    });

    $('#frm-login').click(function () {
        hideAllErrors();
    });

    $('#frm-login input').keyup(function () {
        hideAllErrors();
    });

});
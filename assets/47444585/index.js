$(function () {

    $('[name=AddMaderas]').addClass('active');

    $('#btn-maderas').click(function () {
        InsertarMadera();
    });

    ('#frm-mad').click(function () {
        hideAllErrors();
    });

    $('input,textarea,select').keyup(function () {
        hideAllErrors();
    });

    function InsertarMadera() {
        var data = new FormData($("#frm-mad")[0]);
        id = $('#Id_Mad').val();
        $.ajax({
            url: (id) ? 'UpdateMadera' : 'InsertarMadera',
            data: data,
            type: 'post',
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.error) {
                    hideAllErrors();
                    k = Object.keys(data.info)[0];
                    showError("#" + k, data.info[k]);
                    $('#' + k).focus();
                } else {
                    window.location.assign('./Maderas');
                }
            }
        });
    }

});
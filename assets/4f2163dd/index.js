$(function () {

    $('[name=AddMaderas]').addClass('active');

    $('#btn-maderas').click(function () {
        InsertarMadera();
    });

    function InsertarMadera() {
        var data = new FormData($("#frm-prd")[0]);
        id = $('#Id_Mue').val();
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
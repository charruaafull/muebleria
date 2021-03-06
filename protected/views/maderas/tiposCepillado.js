$(function () {

    $('#tbl-sub').DataTable();

    $('.dt-button').addClass('btn btn-success');
    $('#tbl-sub_length').css('width', '15%');
    $('#tbl-sub_length').css('float', 'left');
    $('div.dt-buttons').css('width', '30%');
    $('div.dt-buttons').css('float', 'left');

    $('#frm-sca').click(function () {
        hideAllErrors();
    });

    $('input,textarea,select').keyup(function () {
        hideAllErrors();
    });

    $('#btn-sca').click(function () {
        InsertarSubcategoria();
    });

    function InsertarSubcategoria() {
        data = $('#frm-sca').serialize();
        $.ajax({
            url: 'InsertarTipoCepillado',
            data: data,
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.error) {
                    hideAllErrors();
                    k = Object.keys(data.info)[0];
                    showError("#" + k, data.info[k]);
                    $('#' + k).focus();
                } else {
                    window.location.assign('./TiposCepillados');
                }
            }
        });
    }

    $('[tag=lnk-del]').click(function () {
        Id_Cep = $(this).attr('nroId');
        nom = $(this).attr('nom');
        if (window.confirm("¿Desea eliminar la categoría " + nom + "?")) {
            $.ajax({
                url: 'DeleteTipoCepillado',
                data: {Id_Cep: Id_Cep},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        location.reload();
                    }
                }
            })
        }
    });


});
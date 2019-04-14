$(function () {
    $('[name=SubsubcategoriaMad]').addClass('active');

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
            url: 'InsertarSubSubcategoria',
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
                    window.location.assign('./Subsubcategorias');
                }
            }
        });
    }

    $('[tag=lnk-del]').click(function () {
        Id_Ssm = $(this).attr('nroId');
        nom = $(this).attr('nom');
        if (window.confirm("¿Desea eliminar la categoría " + nom + "?")) {
            $.ajax({
                url: 'EliminarSubSubcategoria',
                data: {Id_Ssm: Id_Ssm},
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
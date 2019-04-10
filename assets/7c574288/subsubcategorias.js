$(function () {
    $('[name=SubsubcategoriaMad]').addClass('active');

    $('#tbl-sub').DataTable({
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                exportOptions: {
                    columns: [1, 2]
                },
                customize: function (doc) {
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            }
        ],

    });

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
            url: 'InsertarSubcategoria',
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
                    window.location.assign('./Subcategorias');
                }
            }
        });
    }

    $('[tag=lnk-del]').click(function () {
        Id_Sma = $(this).attr('nroId');
        nom = $(this).attr('nom');
        if (window.confirm("¿Desea eliminar la categoría " + nom + "?")) {
            $.ajax({
                url: 'EliminarSubcategoria',
                data: {Id_Sma: Id_Sma},
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
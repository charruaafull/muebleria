$(function () {
    $('[name=inicio]').addClass('active');


    $('#tbl-prod').DataTable({
        dom: 'lBfrtip',
        'oTableTools' : {
            'aButtons': ['copy', 'csv', 'pdf', 'print']
        }
    });

    $('.dt-button').addClass('btn btn-success');
    $('#tbl-prod_length').css('width', '15%');
    $('#tbl-prod_length').css('float', 'left');
    $('div.dt-buttons').css('width', '30%');
    $('div.dt-buttons').css('float', 'left');

    $('#Cod_Mad').autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.ajax({
                url: "AjaxSugerirCodigos",
                data: {q: request.term, jui: 0},
                dataType: 'json',
                type: 'get',
                success: function (data) {
                    response(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if (xhr.status == 403) {
                        alert('Su sesión ha expirado, inicie sesión nuevamente.')
                    }
                }
            });
        },
        select: function (event, ui) {
            $('#Cod_Mad').val(ui.item.cod);
            $('#Id_Mad').val(ui.item.id);
        },
        change: function (event, ui) {
            if (ui.item == null) {
                $('#Cod_Mad').val('');
                $('#Id_Mad').val('');
            }
        }
    });


    $('[tag=lnk-img2]').click(function (e) {
        lnk = $(this).attr('lnk');
        nom = $(this).attr('nom');
        nro = $(this).attr('nro');
        $('.modal-title').html(nom + ' - Imágen: ' + nro);
        $('#img-mod').attr('src', lnk);
        $('#myModal').modal();
        e.preventDefault();
    });

    $('[tag=lnk-del]').click(function () {
        Id_Mue = $(this).attr('nroId');
        nom = $(this).attr('nom');
        if (window.confirm("¿Desea eliminar el producto " + nom + "?")) {
            $.ajax({
                url: 'EliminarProducto',
                data: {Id_Mue: Id_Mue},
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

    $('#btn-search').click(function () {
        $('#frm-search').submit();
    });

});
$(function () {
    $('[name=inicio]').addClass('active');


    var table = $('#tbl-prod').DataTable({
        dom: 'lBfrtip',
        buttons: [
            { extend: 'print', exportOptions:
                    { columns: ':visible' }
            },
            { extend: 'copy', exportOptions:
                    { columns: [ 0, ':visible' ] }
            },
            { extend: 'excel', exportOptions:
                    { columns: ':visible' }
            },
            { extend: 'pdf', exportOptions:
                    { columns: [ 0, 1, 2, 3, 4 ] }
            },
            { extend: 'colvis',   postfixButtons: [ 'colvisRestore' ] }
        ],
        language: {
            buttons: {
                print: 'Stampa',
                copy: 'Copia',
                colvis: 'Colonne da visualizzare'
            } //buttons
        }, //language
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });

    $('#Cod_Mue').autocomplete({
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
                        alert('Su sesiÃ³n ha expirado, inicie sesiÃ³n nuevamente.')
                    }
                }
            });
        },
        select: function (event, ui) {
            $('#Cod_Mue').val(ui.item.cod);
            $('#Nom_Mue').val(ui.item.nom);
            $('#Id_Mue').val(ui.item.id);
        },
        change: function (event, ui) {
            if (ui.item == null) {
                $('#Cod_Mue').val('');
                $('#Nom_Mue').val('');
                $('#Id_Mue').val('');
            }
        }
    });

    $('#Nom_Mue').autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.ajax({
                url: "AjaxSugerirNombres",
                data: {q: request.term, jui: 0},
                dataType: 'json',
                type: 'get',
                success: function (data) {
                    response(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if (xhr.status == 403) {
                        alert('Su sesiÃ³n ha expirado, inicie sesiÃ³n nuevamente.')
                    }
                }
            });
        },
        select: function (event, ui) {
            $('#Cod_Mue').val(ui.item.cod);
            $('#Id_Mue').val(ui.item.id);
            $('#Id_Prov').val('');
            $('#Pro_Mue').val('');
        },
        change: function (event, ui) {
            if (ui.item == null) {
                $('#Cod_Mue').val('');
                $('#Id_Mue').val('');
                $('#Id_Prov').val('');
            }
        }
    });

    $('#Pro_Mue').autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.ajax({
                url: "AjaxSugerirProveedores",
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
            $('#Id_Prov').val(ui.item.id);
            $('#Nom_Mue').val('');
            $('#Cod_Mue').val('');
            $('#Id_Mue').val('');
        },
        change: function (event, ui) {
            if (ui.item == null) {
                $('#Cod_Mue').val('');
                $('#Nom_Mue').val('');
                $('#Id_Mue').val('');
            }
        }
    });

    $('[tag=lnk-img]').click(function () {
        lnk = $(this).attr('lnk');
        nom = $(this).attr('nom');
        nro = $(this).attr('nro');
        $('.modal-title').html(nom + ' - Imágen: ' + nro);
        $('#img-mod').attr('src', lnk);
        $('#myModal').modal();
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
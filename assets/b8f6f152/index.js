$(function () {

    $('[name=AddMaderas]').addClass('active');

    $('#btn-maderas').click(function () {
        InsertarMadera();
    });

    $('#frm-mad').click(function () {
        hideAllErrors();
    });

    $('input,textarea,select').keyup(function () {
        hideAllErrors();
    });

    $('[tag=lnk-del]').click(function () {
        Id_Mad = $(this).attr('nroId');
        var cod = $(this).attr('cod');
        if (window.confirm("¿Desea eliminar la madera " + cod + "?")) {
            $.ajax({
                url: 'DeleteMadera',
                data: {Id_Mad: Id_Mad},
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

    $('#tbl-mad').DataTable({
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8]
                },
                customize: function (doc) {
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            }
        ]
    });

    $('.dt-button').addClass('btn btn-success');
    $('#tbl-prod_length').css('width', '15%');
    $('#tbl-prod_length').css('float', 'left');
    $('div.dt-buttons').css('width', '30%');
    $('div.dt-buttons').css('float', 'left');

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
                    window.location.assign('./index');
                }
            }
        });
    }

    $('[tag=lnk-img]').click(function (e) {
        alert(1);
        var lnk = $(this).attr('lnk');
        $('.modal-title').html('Imágen');
        $('#img-mod').attr('src', lnk);
        $('#myModal').modal();
        e.preventDefault();
    });

    $('#Sub_Mad').change(function () {
        val = $(this).val();
        getSubcategorias(val);
    });

    function getSubcategorias(Id_Sma) {
        $("#Ssc_Mad").html('');
        $("#Ssc_Mad").append('<option value="">Seleccione una opción</option>');
        $.ajax({
            url: 'GetSubSubcategorias',
            data: {Id_Sma: Id_Sma},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data) {
                    for (var i = 0; i < data.length; i++) {
                        $("#Ssc_Mad").append('<option value=' + data[i].Id_Ssm + '>' + data[i].Nom_Ssm + '</option>');
                    }
                }
            }
        })
    }

});
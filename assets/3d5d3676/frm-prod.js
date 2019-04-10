$(function () {
    /*$('[name=AddProductos]').addClass('active');*/

    $('#frm-prd').click(function () {
        hideAllErrors();
    });

    $('input,textarea,select').keyup(function () {
        hideAllErrors();
    });

    $('#btn-productos').click(function () {
        InsertarProducto();
    });

    function InsertarProducto() {
        //data = $('#frm-prd').serialize();
        var data = new FormData($("#frm-prd")[0]);
        id = $('#Id_Mue').val();
        $.ajax({
            url: (id) ? 'ModificarProducto' : 'InsertarProducto',
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
                    window.location.assign('./Productos');
                }
            }
        });
    }

    function calculoPrecio() {
        Pco_Mue = $('#Pco_Mue').val();
        Uti_Mue = $('#Uti_Mue').val();
        Pre_Mue = 0;

        if (Pco_Mue && Uti_Mue) {
            Utilidad = (parseFloat(Pco_Mue) * parseFloat(Uti_Mue)) / 100;
            Pre_Mue = parseFloat(Pco_Mue) + parseFloat(Utilidad);
            $('#Pre_Mue').val(Pre_Mue);
        }

    }

    $('#Pco_Mue,#Uti_Mue').blur(function () {
        calculoPrecio();
    });


    /*
    View
     */

    $('[tag=lnk-img]').click(function (e) {
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

    $('#tbl-prod').DataTable({
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                },
                customize: function (doc) {
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            }
        ],
    });

    $('.dt-button').addClass('btn btn-success');
    $('#tbl-prod_length').css('width', '15%');
    $('#tbl-prod_length').css('float', 'left');
    $('div.dt-buttons').css('width', '30%');
    $('div.dt-buttons').css('float', 'left');

    $('#Cat_Mue').change(function () {
        val = $(this).val();
        getSubcategorias(val);
    });

    function getSubcategorias(Id_Cat) {
        $("#Sca_Mue").html('');
        $("#Sca_Mue").append('<option value="">Seleccione una opción</option>');
        $.ajax({
            url: 'GetSubcategorias',
            data: {Id_Cat: Id_Cat},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data) {
                    for (var i = 0; i < data.length; i++) {
                        $("#Sca_Mue").append('<option value=' + data[i].Id_Sub + '>' + data[i].Nom_Sub + '</option>');
                    }
                }
            }
        })
    }

});
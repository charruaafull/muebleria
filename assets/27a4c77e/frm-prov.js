$(function () {
    $('[name=Proveedores]').addClass('active');

    $('#tbl-prov').DataTable({
        dom: 'lBfrtip',
        buttons: [
            'pdfHtml5'
        ]
    });

    $('.dt-button').addClass('btn btn-success');
    $('#tbl-prov_length').css('width', '15%');
    $('#tbl-prov_length').css('float', 'left');
    $('div.dt-buttons').css('width', '30%');
    $('div.dt-buttons').css('float', 'left');

    $('#frm-prd').click(function () {
        hideAllErrors();
    });

    $('input,textarea,select').keyup(function () {
        hideAllErrors();
    });

    $('#btn-prov').click(function () {
        InsertarProveedor();
    });

    function InsertarProveedor() {
        data = $('#frm-prov').serialize();
        id = $('#Id_Prov').val();
        $.ajax({
            url: (id) ? 'ModificarProveedor' : 'InsertarProveedor',
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
                    window.location.assign('./Proveedores');
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

    $('#Pro_Prov').change(function () {
        if ($(this).val() != '') {
            getLocalidades($(this).val());
        }
    });

    if ($('#Id_Prov').val() == '') {
        $('#Pro_Prov').val(22);
    }

    $('#Pro_Prov').trigger('change');

    function getLocalidades(pro) {
        $('#Loc_Prov').empty();
        var select = document.getElementById("Loc_Prov");
        $.ajax({
            url: 'GetLocalidades',
            data: {pro: pro},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                $("#Loc_Prov").append('<option value=' + '' + '>' + 'Selecciones una opción' + '</option>');
                for (var i = 0; i < data.length; i++) {
                    sel = '';
                    if (pro == 22 && $('#Id_Prov').val() == '') {
                        sel = (data[i].id == 2104) ? 'selected="selected"' : '';
                    } else {
                        valSel = $('#Upd_Loc_Prov').val();
                        if (valSel) {
                            sel = (data[i].id == valSel) ? 'selected="selected"' : '';
                        }
                    }
                    $("#Loc_Prov").append('<option ' + sel + ' value=' + data[i].id + '>' + data[i].loc + '</option>');
                }
            }
        });
    }

    $('[tag=lnk-del]').click(function () {
        Id_Prov = $(this).attr('nroId');
        nom = $(this).attr('nom');
        if (window.confirm("¿Desea eliminar el proveedor " + nom + "?")) {
            $.ajax({
                url: 'EliminarProveedor',
                data: {Id_Prov: Id_Prov},
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
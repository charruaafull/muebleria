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

    $('#tbl-mad').DataTable({
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

});
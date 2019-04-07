<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="es">
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/vendors/iconfonts/mdi/css/materialdesignicons.min.css">

    <!--<link rel="stylesheet" href="<?php /*echo Yii::app()->request->baseUrl; */?>/vendors/css/vendor.bundle.base.css">-->

    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">

    <!--Agrego JS-->
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <!--<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/function.js"></script>


    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

    <?php
    $action = Yii::app()->controller->action->id;
    $controller = Yii::app()->controller->id;
    ?>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php
if ($action != 'login' && ($action != 'index' || $controller == 'maderas')):
require Yii::getPathOfAlias('application.views.layouts.header') . '.php'; ?>
<div class="main-panel">
    <div class="content-wrapper">
        <?php endif; ?>
        <?php echo $content; ?>

        <?php if ($action != 'login' && $action != 'index'): ?>
    </div>
    <?php require Yii::getPathOfAlias('application.views.layouts.footer') . '.php';
    endif;
    ?>


    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/off-canvas.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/misc.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

</body>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        sPaginationType: "full_numbers",
        language: {
            decimal: ",",
            thousands: ".",
            emptyTable: "No hay datos para mostrar.",
            info: "_START_-_END_ de _TOTAL_",
            infoEmpty: " ",
            infoFiltered: "(filtrado sobre _MAX_)",
            infoPostFix: "",
            lengthMenu: "_MENU_ por página",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "No hay registros coincidentes encontrados.",
            paginate: {
                first: "<<",
                last: ">>",
                next: ">",
                previous: "<"
            },
            aria: {
                sortAscending: ": orden ascendente",
                sortDescending: ": orden descendente"
            }
        },
        // Esto se ejecuta siempre que se dibuja una dataTable
        // y evita que se creen dos header cuando se activa el scroll
        drawCallback: function () {
            //Si la tabla tiene un atributo nofix no se aplica la correcciÃ³n
            if (typeof $('.dataTables_scrollBody thead').parent().attr('nofix') === 'undefined') {
                $('.dataTables_scrollBody thead tr').eq(0).css({display: 'none'});
            } else {
                $('.dataTables_scrollBody thead').eq(0).css({display: 'contents'});
            }


        }
    });

</script>


</html>


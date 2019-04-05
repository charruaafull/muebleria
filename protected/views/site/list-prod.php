<?php
!(@dir(Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.site.list-prod') . '.js'))) ? Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.site') . '/list-prod.js') : null;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Buscar Productos
            </div>
            <div class="card-body">
                <form id="frm-search" method="get" action="ListarProductos">
                    <input type="hidden" name="search" id="search" value="1">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" class="form-control"
                                       value="<?php echo (isset($_GET['Cod_Mue'])) ? $_GET['Cod_Mue'] : '' ?>"
                                       name="Cod_Mue" id="Cod_Mue">
                                <input type="hidden" class="form-control"
                                       value="<?php echo (isset($_GET['Id_Mue'])) ? $_GET['Id_Mue'] : '' ?>"
                                       name="Id_Mue" id="Id_Mue">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control"
                                       value="<?php echo (isset($_GET['Nom_Mue'])) ? $_GET['Nom_Mue'] : '' ?>"
                                       name="Nom_Mue" id="Nom_Mue">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Proveedor</label>
                                <input type="text" class="form-control"
                                       value="<?php echo (isset($_GET['Pro_Mue'])) ? $_GET['Pro_Mue'] : '' ?>"
                                       name="Pro_Mue" id="Pro_Mue">
                                <input type="hidden" class="form-control"
                                       value="<?php echo (isset($_GET['Id_Prov'])) ? $_GET['Id_Prov'] : '' ?>"
                                       name="Id_Prov" id="Id_Prov">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Categoría</label>
                                <select class="form-control" id="Cat_Mue" name="Cat_Mue">
                                    <option value="">Todas</option>
                                    <option value="1">Muebles</option>
                                    <option value="2">Ferretería</option>
                                </select>
                                <script>
                                    $('#Cat_Mue').val('<?php echo (isset($_GET['Cat_Mue'])) ? $_GET['Cat_Mue'] : ''; ?>');
                                </script>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Subcategoría</label>
                                <select class="form-control" id="Sca_Mue" name="Sca_Mue">
                                    <option value="">Todas</option>
                                    <?php $cat = Consultas::getSubcategorias(); ?>
                                    <?php foreach($cat as $c): ?>
                                        <option value="<?php echo $c['Id_Sub']; ?>"><?php echo $c['Nom_Sub']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <script>
                                    $('#Sca_Mue').val('<?php echo (isset($_GET['Sca_Mue'])) ? $_GET['Sca_Mue'] : ''; ?>');
                                </script>
                                <script>
                                    $('#Cat_Mue').val('<?php echo (isset($_GET['Cat_Mue'])) ? $_GET['Cat_Mue'] : ''; ?>');
                                </script>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-right">
                <button id="btn-search" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>
            </div>
        </div>
    </div>
</div>
<?php if (isset($prod)): ?>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Listado de Productos
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if (count($prod) > 0): ?>
                                <div class="table-responsive">
                                    <table id="tbl-prod" class="table">
                                        <thead class="bg-grey">
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Categoría</th>
                                            <th>Subcategoría</th>
                                            <th>Descripción</th>
                                            <th>Medidas</th>
                                            <th>Color</th>
                                            <th>Proveedor</th>
                                            <th>Precio Costo</th>
                                            <th>% Utilidad</th>
                                            <th>Precio</th>
                                            <th>Imagen</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($prod as $pro): ?>
                                            <tr>
                                                <td><?php echo $pro['Cod_Mue']; ?></td>
                                                <td><?php echo $pro['Nom_Mue']; ?></td>
                                                <td><?php echo ($pro['Cat_Mue'] == 1) ? 'Mueblería' : 'Ferretería'; ?></td>
                                                <td><?php echo $pro['Nom_Sub']; ?></td>
                                                <td><?php echo $pro['Des_Mue']; ?></td>
                                                <td><?php echo $pro['Med_Mue']; ?></td>
                                                <td><?php echo $pro['Col_Mue']; ?></td>
                                                <td><?php echo $pro['Nom_Prov']; ?></td>
                                                <td><?php echo $pro['Pco_Mue']; ?></td>
                                                <td><?php echo $pro['Uti_Mue']; ?></td>
                                                <td><?php echo $pro['Pre_Mue']; ?></td>
                                                <td class="text-center">
                                                    <?php if ($pro['Im1_Mue']): ?>
                                                        <a class="text-black" href="#" nro="1"
                                                           nom="<?php echo $pro['Nom_Mue']; ?>"
                                                           lnk="<?php echo Yii::app()->baseUrl . '/protected/runtime/productos/' . $pro['Im1_Mue']; ?>"
                                                           tag="lnk-img"><i class="fa fa-picture-o"></i></a>
                                                    <?php endif; ?>
                                                    <?php if ($pro['Im2_Mue']): ?>
                                                        <a class="text-black" href="#" nro="2"
                                                           nom="<?php echo $pro['Nom_Mue']; ?>"
                                                           lnk="<?php echo Yii::app()->baseUrl . '/protected/runtime/productos/' . $pro['Im2_Mue']; ?>"
                                                           tag="lnk-img"><i class="fa fa-picture-o"></i></a>
                                                    <?php endif; ?>
                                                    <?php if ($pro['Im3_Mue']): ?>
                                                        <a class="text-black" href="#" nro="3"
                                                           nom="<?php echo $pro['Nom_Mue']; ?>"
                                                           lnk="<?php echo Yii::app()->baseUrl . '/protected/runtime/productos/' . $pro['Im3_Mue']; ?>"
                                                           tag="lnk-img"><i class="fa fa-picture-o"></i></a>
                                                    <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                No hay productos agregados
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title"></h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <img id="img-mod" src="" class="img-fluid">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript"
        src="<?php echo Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.site.list-prod') . '.js') ?>">
</script>
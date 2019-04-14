<?php
!(@dir(Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.maderas.list-mad') . '.js'))) ? Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.maderas') . '/list-mad.js') : null;

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Buscar Productos / Maderas
            </div>
            <div class="card-body">
                <form id="frm-search" method="get" action="ListaMaderas">
                    <input type="hidden" name="search" id="search" value="1">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" class="form-control"
                                       value="<?php echo (isset($_GET['Cod_Mad'])) ? $_GET['Cod_Mad'] : '' ?>"
                                       name="Cod_Mad" id="Cod_Mad">
                                <input type="hidden" class="form-control"
                                       value="<?php echo (isset($_GET['Id_Mad'])) ? $_GET['Id_Mad'] : '' ?>"
                                       name="Id_Mad" id="Id_Mad">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Subcategoría</label>
                                <select class="form-control js-entero" name="Sub_Mad" id="Sub_Mad">
                                    <option value="">Seleccione una opción</option>
                                    <?php foreach ($subcat as $sc): ?>
                                        <option <?php echo (isset($pro) && $sc['Id_Sma'] == $_GET['Sub_Mad']) ? 'selected' : ''; ?>
                                                value="<?php echo $sc['Id_Sma']; ?>"><?php echo $sc['Nom_Sma']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Sub - Subcategoría</label>
                                <select class="form-control js-entero" id="Ssc_Mad" name="Ssc_Mad">
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                        $cat = CrudCategorias::getSubSubCategorias();
                                        foreach ($cat as $c): ?>
                                            <option <?php echo (isset($_GET['Ssc_Mad']) && $c['Id_Ssm'] == $_GET['Ssc_Mad']) ? 'selected' : ''; ?>
                                                    value="<?php echo $c['Id_Ssm']; ?>"><?php echo $c['Nom_Ssm']; ?></option>
                                        <?php endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tipo de Cepillado</label>
                                <select class="form-control" name="Tce_Mad" id="Tce_Mad">
                                    <option value="">Seleccione una opción</option>
                                    <?php foreach ($cep as $c): ?>
                                        <option <?php echo (isset($pro) && $_GET['Tce_Mad'] == $c['Id_Cep']) ? 'selected' : ''; ?> value="<?php echo $c['Id_Cep']; ?>"><?php echo $c['Nom_Cep']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Subtipo de Cepillado</label>
                                <select class="form-control" name="Stc_Mad" id="Stc_Mad">
                                    <option value="">Seleccione una opción</option>
                                    <?php foreach ($sce as $c): ?>
                                        <option <?php echo (isset($pro) && $_GET['Stc_Mad'] == $c['Id_Sce']) ? 'selected' : ''; ?> value="<?php echo $c['Id_Sce']; ?>"><?php echo $c['Nom_Sce']; ?></option>
                                    <?php endforeach; ?>
                                </select>
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
<?php if (isset($pro)): ?>
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
                            <?php if (count($pro) > 0): ?>
                                <div class="table-responsive">
                                    <table id="tbl-prod" class="table">
                                        <thead class="bg-grey">
                                        <tr>
                                            <th>Código</th>
                                            <th>Subcategoría</th>
                                            <th>Sub-Subcategoría</th>
                                            <th>Tipo de cepillado</th>
                                            <th>Subtipo de cepillado</th>
                                            <th>Precio M2 (car)</th>
                                            <th>Precio Lineal (car)</th>
                                            <th>Precio Pie (car)</th>
                                            <th>Precio M2 (par)</th>
                                            <th>Precio Pie (par)</th>
                                            <th>Precio Lineal (par)</th>
                                            <th>Imágen</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($pro as $pro1): ?>
                                            <tr>
                                                <td><?php echo $pro1['Cod_Mad']; ?></td>
                                                <td><?php echo $pro1['Nom_Sma']; ?></td>
                                                <td><?php echo $pro1['Nom_Ssm']; ?></td>
                                                <td><?php echo $pro1['Nom_Cep']; ?></td>
                                                <td><?php echo $pro1['Nom_Sce']; ?></td>
                                                <td><?php echo $pro1['Pm2_Car_Mad']; ?></td>
                                                <td><?php echo $pro1['Pli_Car_Mad']; ?></td>
                                                <td><?php echo $pro1['Ppi_Car_Mad']; ?></td>
                                                <td><?php echo $pro1['Pm2_Par_Mad']; ?></td>
                                                <td><?php echo $pro1['Pli_Par_Mad']; ?></td>
                                                <td><?php echo $pro1['Ppi_Par_Mad']; ?></td>
                                                <td>
                                                    <?php if ($pro1['Img_Mad']): ?>
                                                        <a class="text-black" href="#"
                                                           lnk="<?php echo Yii::app()->baseUrl . '/protected/runtime/productos/' . $pro1['Img_Mad']; ?>"
                                                           tag="lnk-img2"><i class="fa fa-picture-o"></i></a>
                                                    <?php endif; ?>
                                                </td>
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
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <a href="./ListaMaderas" class="btn btn-success"><i class="fa fa-undo"></i> Reiniciar</a>
                        </div>
                    </div>
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
        src="<?php echo Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.maderas.list-mad') . '.js') ?>">
</script>
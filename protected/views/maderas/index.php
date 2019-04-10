<?php
!(@dir(Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.maderas.index') . '.js'))) ? Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.maderas') . '/index.js') : null;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Nueva Madera
            </div>
            <div class="card-body">
                <form id="frm-mad">
                    <input type="hidden" name="Id_Mad" id="Id_Mad" readonly
                           value="<?php echo (isset($pro)) ? $pro['Id_Mad'] : ''; ?>">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" name="Cod_Mad"
                                       id="Cod_Mad" <?php echo (isset($pro)) ? 'readonly' : ''; ?>
                                       value="<?php echo (isset($pro)) ? $pro['Cod_Mad'] : ''; ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Imágen</label>
                                <input name="Img_Mad" id="Img_Mad"
                                       value="<?php echo (isset($pro)) ? $pro['Img_Mad'] : ''; ?>" type="file"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Subcategoría</label>
                                <select class="form-control" name="Sub_Mad" id="Sub_Mad">
                                    <option>Seleccione una opción</option>
                                    <?php foreach ($subcat as $sc): ?>
                                        <option <?php echo (isset($pro) && $sc['Id_Sma'] == $pro['Sub_Mad']) ? 'selected' : ''; ?>
                                                value="<?php echo $sc['Id_Sma']; ?>"><?php echo $sc['Nom_Sma']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Sub - Subcategoría</label>
                                <select class="form-control" id="Ssc_Mad" name="Ssc_Mad">
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    if (isset($pro)):
                                        $cat = CrudCategorias::getSubSubCategorias($pro['Sub_Mad']);
                                        foreach ($cat as $c): ?>
                                            <option <?php echo ($c['Id_Ssm'] == $pro['Ssc_Mad']) ? 'selected' : ''; ?> value="<?php echo $c['Id_Ssm']; ?>"><?php echo $c['Nom_Ssm']; ?></option>
                                        <?php endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tipo de Cepillado</label>
                                <input type="text" name="Tce_Mad" id="Tce_Mad" class="form-control"
                                       value="<?php echo (isset($pro)) ? $pro['Tce_Mad'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Subtipo de Cepillado</label>
                                <input type="text" name="Stc_Mad" id="Stc_Mad" class="form-control"
                                       value="<?php echo (isset($pro)) ? $pro['Stc_Mad'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Precio de Carpintero</label>
                                <input type="text" name="Prc_Mad" id="Prc_Mad" class="form-control"
                                       value="<?php echo (isset($pro)) ? $pro['Prc_Mad'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Precio Particular</label>
                                <input type="text" name="Prp_Mad" id="Prp_Mad" class="form-control"
                                       value="<?php echo (isset($pro)) ? $pro['Prp_Mad'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button id="btn-maderas" class="btn btn-success">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($res) && count($res) > 0): ?>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Listado de Maderas
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="tbl-mad" class="table">
                                    <thead class="bg-grey">
                                    <tr>
                                        <th>Acciones</th>
                                        <th>Código</th>
                                        <th>Subcategoría</th>
                                        <th>Sub-Subcategoría</th>
                                        <th>Tipo de cepillado</th>
                                        <th>Subtipo de cepillado</th>
                                        <th>Precio Carpintero</th>
                                        <th>Precio Particular</th>
                                        <th>Imágen</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($res as $pro): ?>
                                        <tr>
                                            <td class="text-center">
                                                <a class="text-black"
                                                   href="./Index?upd=<?php echo $pro['Id_Mad'] ?>"><i
                                                            class="fa fa-edit"></i></a>
                                                <a href="#" class="text-black" cod="<?php echo $pro['Cod_Mad']; ?>"
                                                   tag="lnk-del" nroId="<?php echo $pro['Id_Mad']; ?>"><i
                                                            class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td><?php echo $pro['Cod_Mad']; ?></td>
                                            <td><?php echo $pro['Nom_Sma']; ?></td>
                                            <td><?php echo $pro['Nom_Ssm']; ?></td>
                                            <td><?php echo $pro['Tce_Mad']; ?></td>
                                            <td><?php echo $pro['Stc_Mad']; ?></td>
                                            <td><?php echo $pro['Prc_Mad']; ?></td>
                                            <td><?php echo $pro['Prp_Mad']; ?></td>
                                            <td>
                                                <?php if ($pro['Img_Mad']): ?>
                                                    <a class="text-black" href="#"
                                                       lnk="<?php echo Yii::app()->baseUrl . '/protected/runtime/productos/' . $pro['Img_Mad']; ?>"
                                                       tag="lnk-img"><i class="fa fa-picture-o"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
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
        src="<?php echo Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.maderas.index') . '.js') ?>">
</script>
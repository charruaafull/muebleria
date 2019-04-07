<?php
!(@dir(Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.maderas.index') . '.js'))) ? Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.maderas') . '/index.js') : null;
?>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Nuevo Producto
            </div>
            <div class="card-body">
                <form id="frm-prd">
                    <input type="hidden" name="Id_Mue" id="Id_Mue" readonly
                           value="<?php echo (isset($pro)) ? $pro['Id_Mue'] : ''; ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" name="Cod_Mue"
                                       id="Cod_Mue" <?php echo (isset($pro)) ? 'readonly' : ''; ?>
                                       value="<?php echo (isset($pro)) ? $pro['Cod_Mue'] : ''; ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="Nom_Mue" id="Nom_Mue" class="form-control"
                                       value="<?php echo (isset($pro)) ? $pro['Nom_Mue'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Categoría</label>
                                <select name="Cat_Mue" id="Cat_Mue" type="text" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                    <option <?php echo (isset($pro) && $pro['Cat_Mue'] == 1) ? 'selected' : ''; ?>
                                            value="1">Mueblería
                                    </option>
                                    <option <?php echo (isset($pro) && $pro['Cat_Mue'] == 2) ? 'selected' : ''; ?>
                                            value="2">Ferretería
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Subcategoría</label>
                                <select name="Sca_Mue" id="Sca_Mue" type="text" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    if (isset($pro)):
                                        $sca = Consultas::getSubcategorias($pro['Cat_Mue']);
                                        foreach ($sca as $sc): ?>
                                            <option <?php echo ($pro['Sca_Mue'] == $sc['Id_Sub']) ? 'selected' : ''; ?>
                                                    value="<?php echo $sc['Id_Sub']; ?>"><?php echo $sc['Nom_Sub']; ?></option>
                                        <?php endforeach;
                                    endif;
                                    ?>
                                    <!--<option <?php /*echo (isset($pro) && $pro['Sca_Mue'] == 1) ? 'selected' : ''; */ ?> value="1">Subcategoría 1</option>
                                    <option <?php /*echo (isset($pro) && $pro['Sca_Mue'] == 2) ? 'selected' : ''; */ ?> value="2">Subcategoría 2</option>
                                    <option <?php /*echo (isset($pro) && $pro['Sca_Mue'] == 3) ? 'selected' : ''; */ ?> value="3">Subcategoría 3</option>-->
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="Des_Mue" id="Des_Mue"
                                          class="form-control"><?php echo (isset($pro)) ? trim($pro['Des_Mue']) : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Medidas</label>
                                <input name="Med_Mue" id="Med_Mue"
                                       value="<?php echo (isset($pro)) ? $pro['Med_Mue'] : ''; ?>" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Color</label>
                                <input name="Col_Mue" id="Col_Mue"
                                       value="<?php echo (isset($pro)) ? $pro['Col_Mue'] : ''; ?>" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Proveedor</label>
                                <select name="Pro_Mue" id="Pro_Mue"
                                        value="<?php echo (isset($pro)) ? $pro['Pro_Mue'] : ''; ?>"
                                        class="form-control">
                                    <?php
                                    $prov = Consultas::getProveedores();
                                    foreach ($prov as $prv): ?>
                                        <option value="<?php echo $prv['Id_Prov']; ?>"><?php echo $prv['Nom_Prov']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Precio Costo</label>
                                <input name="Pco_Mue" id="Pco_Mue"
                                       value="<?php echo (isset($pro)) ? $pro['Pco_Mue'] : ''; ?>" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>% Utilidad</label>
                                <input name="Uti_Mue" id="Uti_Mue"
                                       value="<?php echo (isset($pro)) ? $pro['Uti_Mue'] : ''; ?>" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Otra % Utilidad</label>
                                <input name="Out_Mue" id="Out_Mue"
                                       value="<?php echo (isset($pro)) ? $pro['Out_Mue'] : ''; ?>" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Precio Particular</label>
                                <input name="Pre_Mue" id="Pre_Mue"
                                       value="<?php echo (isset($pro)) ? $pro['Pre_Mue'] : ''; ?>" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Precio Carpitero</label>
                                <input name="Pr2_Mue" id="Pr2_Mue"
                                       value="<?php echo (isset($pro)) ? $pro['Pr2_Mue'] : ''; ?>" type="text"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Imágen 1</label>
                                <input name="Im1_Mue" id="Im1_Mue"
                                       value="<?php echo (isset($pro)) ? $pro['Im1_Mue'] : ''; ?>" type="file"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Imágen 2</label>
                                <input name="Im2_Mue" id="Im2_Mue"
                                       value="<?php echo (isset($pro)) ? $pro['Im2_Mue'] : ''; ?>" type="file"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Imágen 3</label>
                                <input name="Im3_Mue" id="Im3_Mue"
                                       value="<?php echo (isset($pro)) ? $pro['Im3_Mue'] : ''; ?>" type="file"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button id="btn-productos" class="btn btn-success">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"
        src="<?php echo Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.maderas.index') . '.js') ?>">
</script>
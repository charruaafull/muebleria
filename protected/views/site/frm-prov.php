<?php
!(@dir(Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.site.frm-prov') . '.js'))) ? Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.site') . '/frm-prov.js') : null;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Nuevo Proveedor
            </div>
            <div class="card-body">
                <form id="frm-prov">
                    <input type="hidden" name="Id_Prov" id="Id_Prov" readonly
                           value="<?php echo (isset($prov)) ? $prov['Id_Prov'] : ''; ?>">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                <input type="text" name="Nom_Prov" id="Nom_Prov"
                                       value="<?php echo (isset($prov)) ? $prov['Nom_Prov'] : ''; ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Provincia</label>
                                <select name="Pro_Prov" id="Pro_Prov" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    $pro = Consultas::getProvincias();
                                    $sel = '';
                                    foreach ($pro as $p):
                                        if (isset($prov) && $p['Id_Pro'] == $prov['Pro_Prov']):
                                            $sel = "selected";
                                        else:
                                            $sel = "";
                                        endif;
                                        ?>
                                        <option <?php echo $sel; ?>
                                                value="<?php echo $p['Id_Pro']; ?>"><?php echo $p['Nom_Pro']; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Localidad</label>
                                <select name="Loc_Prov" id="Loc_Prov" class="form-control">
                                </select>
                                <input type="hidden" value="<?php echo (isset($prov)) ? $prov['Loc_Prov'] : ''; ?>" name="Upd_Loc_Prov" id="Upd_Loc_Prov">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Referencia</label>
                                <textarea name="Ref_Prov" id="Ref_Prov" maxlength="600"
                                          class="form-control"><?php echo (isset($prov)) ? trim($prov['Ref_Prov']) : ''; ?></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button id="btn-prov" class="btn btn-success">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($provL) && count($provL) > 0): ?>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Listado de Proveedores
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="tbl-prov" class="table">
                                    <thead class="bg-grey">
                                    <tr>
                                        <th>Acciones</th>
                                        <th>Nombre</th>
                                        <th>Provincia</th>
                                        <th>Localidad</th>
                                        <th>Referencia</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($provL as $pro): ?>
                                        <tr>
                                            <td class="text-center">
                                                <a class="text-black"
                                                   href="./Proveedores?upd=<?php echo $pro['Id_Prov'] ?>"><i
                                                            class="fa fa-edit"></i></a>
                                                <a href="#" class="text-black" nom="<?php echo $pro['Nom_Prov']; ?>"
                                                   tag="lnk-del" nroId="<?php echo $pro['Id_Prov']; ?>"><i
                                                            class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td><?php echo $pro['Nom_Prov']; ?></td>
                                            <td><?php echo $pro['Nom_Pro']; ?></td>
                                            <td><?php echo $pro['Nom_Loc']; ?></td>
                                            <td><?php echo $pro['Ref_Prov']; ?></td>
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

<script type="text/javascript"
        src="<?php echo Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.site.frm-prov') . '.js') ?>">
</script>
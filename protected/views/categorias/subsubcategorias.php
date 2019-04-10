<?php
!(@dir(Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.categorias.subsubcategorias') . '.js'))) ? Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.categorias') . '/subsubcategorias.js') : null;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Nueva Sub-Subcategoria s./Maderas
            </div>
            <div class="card-body">
                <form id="frm-sca">
                    <input type="hidden" name="Id_Ssm" id="Id_Ssm" readonly
                           value="<?php echo (isset($ssm)) ? $ssm['Id_Ssm'] : ''; ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Subcategoría</label>
                                <select class="form-control" name="Sma_Ssm" id="Sma_Ssm">
                                    <option>Seleccione una opción</option>
                                    <?php foreach ($subcat as $sc): ?>
                                        <option <?php echo (isset($ssm) && $sc['Id_Sma'] == $ssm['Sma_Ssm']) ? 'selected' : ''; ?> value="<?php echo $sc['Id_Sma']; ?>"><?php echo $sc['Nom_Sma']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                <input type="text" name="Nom_Ssm" id="Nom_Ssm"
                                       value="<?php echo (isset($ssm)) ? $ssm['Nom_Ssm'] : ''; ?>"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button id="btn-sca" class="btn btn-success">Confirmar</button>
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
                    Listado de Subcategorías s./Maderas
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="tbl-sub" class="table">
                                    <thead class="bg-grey">
                                    <tr>
                                        <th>Acciones</th>
                                        <th>SubCategoría</th>
                                        <th>Sub-SubCategoría</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($res as $r): ?>
                                        <tr>
                                            <td class="text-center">
                                                <a class="text-black"
                                                   href="./subsubcategorias?upd=<?php echo $r['Id_Ssm'] ?>"><i
                                                            class="fa fa-edit"></i></a>
                                                <a href="#" class="text-black" nom="<?php echo $r['Nom_Ssm']; ?>"
                                                   tag="lnk-del" nroId="<?php echo $r['Id_Ssm']; ?>"><i
                                                            class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td><?php echo $r['Nom_Sma']; ?></td>
                                            <td><?php echo $r['Nom_Ssm']; ?></td>
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
        src="<?php echo Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.categorias.subsubcategorias') . '.js') ?>">
</script>
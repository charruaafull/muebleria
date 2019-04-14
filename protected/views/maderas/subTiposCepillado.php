<?php
!(@dir(Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.maderas.subTiposCepillado') . '.js'))) ? Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.maderas') . '/subTiposCepillado.js') : null;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Nueva Sub Tipo de Cepillado
            </div>
            <div class="card-body">
                <form id="frm-sca">
                    <input type="hidden" name="Id_Sce" id="Id_Sce" readonly
                           value="<?php echo (isset($sce)) ? $sce['Id_Sce'] : ''; ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                <input type="text" name="Nom_Sce" id="Nom_Sce"
                                       value="<?php echo (isset($sce)) ? $sce['Nom_Sce'] : ''; ?>"
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
                    Listado de Tipos de Cepillados
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="tbl-sub" class="table">
                                    <thead class="bg-grey">
                                    <tr>
                                        <th>Acciones</th>
                                        <th>Categoría</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($res as $r): ?>
                                        <tr>
                                            <td class="text-center">
                                                <a class="text-black"
                                                   href="./SubTiposCepillados?upd=<?php echo $r['Id_Sce'] ?>"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="#" class="text-black" nom="<?php echo $r['Nom_Sce']; ?>"
                                                   tag="lnk-del" nroId="<?php echo $r['Id_Sce']; ?>"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td><?php echo $r['Nom_Sce']; ?></td>
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
        src="<?php echo Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.maderas.subTiposCepillado') . '.js') ?>">
</script>
<?php
!(@dir(Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.maderas.tiposCepillado') . '.js'))) ? Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.maderas') . '/tiposCepillado.js') : null;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Nueva Tipo de Cepillado
            </div>
            <div class="card-body">
                <form id="frm-sca">
                    <input type="hidden" name="Id_Cep" id="Id_Cep" readonly
                           value="<?php echo (isset($cep)) ? $cep['Id_Cep'] : ''; ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                <input type="text" name="Nom_Cep" id="Nom_Cep"
                                       value="<?php echo (isset($cep)) ? $cep['Nom_Cep'] : ''; ?>"
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
                                                   href="./TiposCepillados?upd=<?php echo $r['Id_Cep'] ?>"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="#" class="text-black" nom="<?php echo $r['Nom_Cep']; ?>"
                                                   tag="lnk-del" nroId="<?php echo $r['Id_Cep']; ?>"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td><?php echo $r['Nom_Cep']; ?></td>
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
        src="<?php echo Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.maderas.tiposCepillado') . '.js') ?>">
</script>
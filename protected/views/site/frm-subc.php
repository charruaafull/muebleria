<?php
!(@dir(Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.site.frm-subc') . '.js'))) ? Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.site') . '/frm-subc.js') : null;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Nueva Subcategoria
            </div>
            <div class="card-body">
                <form id="frm-sca">
                    <input type="hidden" name="Id_Sca" id="Id_Sca" readonly
                           value="<?php echo (isset($subc)) ? $subc['Id_Sub'] : ''; ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                <input type="text" name="Nom_Sca" id="Nom_Sca"
                                       value="<?php echo (isset($subc)) ? $subc['Nom_Sub'] : ''; ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Categoría</label>
                                <select name="Cat_Sca" id="Cat_Sca" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                    <option value="1">Mueblería</option>
                                    <option value="2">Ferretería</option>
                                </select>
                                <script>
                                    $(function () {
                                        $('#Cat_Sca').val(<?php echo (isset($subc)) ? $subc['Cat_Sub'] : ''; ?>);
                                    });
                                </script>
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
<?php if (isset($subcL) && count($subcL) > 0): ?>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Listado de Subcategorías
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
                                        <th>Subcategoría</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($subcL as $sca): ?>
                                        <tr>
                                            <td class="text-center">
                                                <a class="text-black"
                                                   href="./Subcategorias?upd=<?php echo $sca['Id_Sub'] ?>"><i
                                                            class="fa fa-edit"></i></a>
                                                <a href="#" class="text-black" nom="<?php echo $sca['Nom_Sub']; ?>"
                                                   tag="lnk-del" nroId="<?php echo $sca['Id_Sub']; ?>"><i
                                                            class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td><?php echo $sca['Nom_Sub']; ?></td>
                                            <td><?php echo ($sca['Cat_Sub'] == 1) ? 'Mueblería' : 'Ferretería'; ?></td>
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
        src="<?php echo Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.site.frm-subc') . '.js') ?>">
</script>
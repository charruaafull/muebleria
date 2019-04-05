<?php
!(@dir(Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.site.index') . '.js'))) ? Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.site') . '/index.js') : null;
?>

<div class="container-fluid page-body-wrapper full-page-wrapper auth-page" style="min-height: 100vh;">
    <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <div class="text-center bg-white">
                    <img class="img-fluid" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png">
                </div>
                <div class="auto-form-wrapper">
                    <form id="frm-login">
                        <div class="form-group">
                            <label class="label">Usuario</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Username" name="username"
                                       id="username">
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="*********">
                                <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group">
                            <button id="btn-login" class="btn btn-success submit-btn btn-block">Ingresar</button>
                        </div>

                </div>
                <p class="footer-text text-center">Todos los derechos reservados</p>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>

<script type="text/javascript"
        src="<?php echo Yii::app()->assetManager->getPublishedUrl(Yii::getPathOfAlias('application.views.site.index') . '.js') ?>">
</script>
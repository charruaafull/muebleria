<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <a class="navbar-brand" href="index.php">
                <img class="img-fluid" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png">
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
                <img class="img-fluid" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png">
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown d-none d-xl-inline-block">
                    <span class="profile-text">EcheverriaMaderas.com</span>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <div class="nav-link">
                        <div class="text-wrapper">
                            <p class="profile-name"> <i class="menu-icon mdi  mdi-account"></i> Hola, <?php echo Yii::app()->session['USU']['Nom_Usu']; ?> !</p>
                        </div>
                    </div>
                </li>
                <li class="nav-item" name="inicio">
                    <a class="nav-link"  href="<?php echo Yii::app()->request->baseUrl; ?>/site/ListarProductos">
                        <i class="menu-icon mdi mdi-television"></i>
                        <span class="menu-title">Inicio</span>
                    </a>
                </li>

                <li class="nav-item" name="AddProductos">
                    <a class="nav-link"  href="<?php echo Yii::app()->request->baseUrl; ?>/site/Productos">
                        <i class="menu-icon mdi mdi-chart-bar"></i>
                        <span class="menu-title">Sección Muebles</span>
                    </a>
                </li>

                <li class="nav-item" name="AddMaderas">
                    <a class="nav-link"  href="<?php echo Yii::app()->request->baseUrl; ?>/maderas/index">
                        <i class="menu-icon mdi mdi-chart-bar"></i>
                        <span class="menu-title">Sección Maderas</span>
                    </a>
                </li>

                <li class="nav-item" name="proveedores">
                    <a class="nav-link"  href="<?php echo Yii::app()->request->baseUrl; ?>/site/Proveedores">
                        <i class="menu-icon mdi  mdi-account-multiple"></i>
                        <span class="menu-title">Proveedores</span>
                    </a>
                </li>

                <li class="nav-item" name="subcategorias">
                    <a class="nav-link"  href="<?php echo Yii::app()->request->baseUrl; ?>/site/Subcategorias">
                        <i class="menu-icon mdi mdi-format-list-bulleted"></i>
                        <span class="menu-title">Subcategorias</span>
                    </a>
                </li>

                <li class="nav-item" name="subcategorias">
                    <a class="nav-link"  href="<?php echo Yii::app()->request->baseUrl; ?>/site/logout">
                        <i class="menu-icon mdi  mdi-logout"></i>
                        <span class="menu-title">Salir</span>
                    </a>
                </li>

            </ul>
        </nav>


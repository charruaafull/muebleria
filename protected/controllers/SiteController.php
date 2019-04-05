<?php

class SiteController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        //metodo usado por el filtro 'accessControl'
        return array(
            //TODOS TIENEN ACCESO A LA ACCION LOGIN, ERROR
            array('allow',
                'actions' => array(
                    'Index',
                    'Login',
                    'AjaxValidaLogin'
                ),
                'users' => array('*'),
            ),
            //TODAS LAS ACCIONES CON ACCESO PARA TODOS LOS USUARIOS LOGGEADOS //
            array('allow',
                'actions' => array(),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array(
                    'Productos',
                    'Logout',
                    'InsertarProducto',
                    'ModificarProducto',
                    'ListarProductos',
                    'EliminarProducto',
                    'Proveedores',
                    'InsertarProveedor',
                    'ModificarProveedor',
                    'GetLocalidades',
                    'EliminarProveedor',
                    'Subcategorias',
                    'InsertarProveedor',
                    'InsertarSubcategoria',
                    'ModificarSubcategoria',
                    'EliminarSubcategoria',
                    'GetSubcategorias',
                    'AjaxSugerirCodigos',
                    'AjaxSugerirNombres',
                    'AjaxSugerirProveedores'
                ),
                'expression' => "Yii::app()->session['USU']", // Yii::app()->session['USU']['Per_Usu']==1
            ),
            //NEGAMOS TODOS LOS USUARIOS
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionAjaxSugerirCodigos()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['q'])):
            $pacientes = Consultas::getCodigos($_GET['q']);
            if (isset($_GET['jui'])):
                $res = array();
                foreach ($pacientes as $p):
                    $res[] = array(
                        'value' => strtoupper($p['Cod_Mue']),
                        'cod' => $p['Cod_Mue'],
                        'nom' => strtoupper($p['Nom_Mue']),
                        'id' => $p['Id_Mue'],
                    );
                endforeach;
                echo CJSON::encode($res);
            endif;
        endif;
    }

    public function actionAjaxSugerirNombres()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['q'])):
            $pacientes = Consultas::getCodProducto($_GET['q']);
            if (isset($_GET['jui'])):
                $res = array();
                foreach ($pacientes as $p):
                    $res[] = array(
                        'value' => strtoupper($p['Nom_Mue']),
                        'cod' => $p['Cod_Mue'],
                        'id' => $p['Id_Mue'],
                    );
                endforeach;
                echo CJSON::encode($res);
            endif;
        endif;
    }

    public function actionAjaxSugerirProveedores()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['q'])):
            $pacientes = Consultas::getCodProveedores($_GET['q']);
            if (isset($_GET['jui'])):
                $res = array();
                foreach ($pacientes as $p):
                    $res[] = array(
                        'value' => strtoupper($p['Nom_Prov']),
                        'id' => $p['Id_Prov']
                    );
                endforeach;
                echo CJSON::encode($res);
            endif;
        endif;
    }

    public function actionIndex()
    {
        if (isset(Yii::app()->session['USU'])):
            $this->redirect('ListarProductos');
        endif;
        $this->pageTitle = 'Login | ' . Yii::app()->name;
        $this->render('index');
    }

    public function actionLogin()
    {
        if (isset(Yii::app()->session['USU'])):
            $this->redirect('ListarProductos');
        endif;
        $this->pageTitle = 'Login | ' . Yii::app()->name;
        $this->render('index');

    }

    public function actionProductos()
    {
        $this->pageTitle = 'Productos | ' . Yii::app()->name;
        $Id_Mue = Yii::app()->request->getParam('upd');
        if (isset($Id_Mue)):
            $pro = Consultas::getProducto($Id_Mue);
            $this->render('frm-prod', array('pro' => $pro));
        else:
            $prod = Consultas::getProductos();
            $Cod_Mue = sistema::generarCodigo();
            $this->render('frm-prod', array('Cod_Mue' => $Cod_Mue, 'prodL' => $prod));
        endif;
    }

    public function actionSubcategorias()
    {
        $this->pageTitle = 'Subcategorías | ' . Yii::app()->name;
        $Id_Subc = Yii::app()->request->getParam('upd');
        if (isset($Id_Subc)):
            $subc = Consultas::getSubcategoria($Id_Subc);
            $this->render('frm-subc', array('subc' => $subc));
        else:
            $subcL = Consultas::getSubcategorias();
            $this->render('frm-subc', array('subcL' => $subcL));
        endif;
    }

    public function actionGetSubcategorias()
    {
        $Id_Cat = Yii::app()->request->getParam('Id_Cat');
        if (isset($Id_Cat)):
            $res = Consultas::getSubcategorias($Id_Cat);
            echo CJSON::encode($res);
        endif;
    }

    public function actionInsertarSubcategoria()
    {

        $model = new frm_subcategoria();
        $model->Cat_Sca = Yii::app()->request->getParam('Cat_Sca');
        $model->Nom_Sca = Yii::app()->request->getParam('Nom_Sca');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            Consultas::insertSubcategoria($model->Cat_Sca, $model->Nom_Sca);
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionModificarSubcategoria()
    {
        $model = new frm_subcategoria();

        $id = Yii::app()->request->getParam('Id_Sca');
        $model->Cat_Sca = Yii::app()->request->getParam('Cat_Sca');
        $model->Nom_Sca = Yii::app()->request->getParam('Nom_Sca');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            Consultas::updateSubcategoria($id, $model->Cat_Sca, $model->Nom_Sca);
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionEliminarSubcategoria()
    {
        $Id_Sub = Yii::app()->request->getParam('Id_Sub');
        if ($Id_Sub):
            $sca = Consultas::deleteSubcategoria($Id_Sub);
            echo CJSON::encode(true);
        endif;
    }

    public function actionGetLocalidades()
    {
        $pro = Yii::app()->request->getParam('pro');
        $prov = Consultas::getLocalidades($pro);
        $pla = array();
        foreach ($prov as $p):
            $pla[] = array(
                'id' => $p['Id_Loc'],
                'loc' => $p['Nom_Loc']
            );
        endforeach;
        echo CJSON::encode($pla);
    }

    public function actionProveedores()
    {
        $this->pageTitle = 'Proveedores | ' . Yii::app()->name;
        $Id_Prov = Yii::app()->request->getParam('upd');
        if (isset($Id_Prov)):
            $pro = Consultas::getProveedor($Id_Prov);
            $this->render('frm-prov', array('prov' => $pro));
        else:
            $prov = Consultas::getProveedores();
            $this->render('frm-prov', array('provL' => $prov));
        endif;
    }

    public function actionListarProductos()
    {
        $this->pageTitle = 'Listado de Productos | ' . Yii::app()->name;

        if (Yii::app()->request->getParam('search')):
            $Id_Mue = Yii::app()->request->getParam('Id_Mue');
            $Id_Prov = Yii::app()->request->getParam('Id_Prov');
            $Cat_Mue = Yii::app()->request->getParam('Cat_Mue');
            $Sca_Mue = Yii::app()->request->getParam('Sca_Mue');
            $prod = Consultas::getProductos($Id_Mue, $Id_Prov, $Cat_Mue, $Sca_Mue);
            $this->render('list-prod', array('prod' => $prod));
            Yii::app()->end();
        endif;
        $this->render('list-prod');
    }

    public function actionEliminarProducto()
    {
        $Id_Mue = Yii::app()->request->getParam('Id_Mue');
        if ($Id_Mue):
            $prd = Consultas::getProducto($Id_Mue);
            $prod = Consultas::deleteProducto($Id_Mue);
            if ($prd['Im1_Mue']):
                unlink(Yii::app()->getBasePath() . '/runtime/productos/' . $prd['Im1_Mue']);
            endif;
            if ($prd['Im2_Mue']):
                unlink(Yii::app()->getBasePath() . '/runtime/productos/' . $prd['Im2_Mue']);
            endif;
            if ($prd['Im3_Mue']):
                unlink(Yii::app()->getBasePath() . '/runtime/productos/' . $prd['Im3_Mue']);
            endif;
            echo CJSON::encode(true);
        endif;
    }

    public function actionInsertarProducto()
    {
        $model = new frm_productos();
        $model->Cod_Mue = Yii::app()->request->getParam('Cod_Mue');
        $model->Nom_Mue = Yii::app()->request->getParam('Nom_Mue');
        $model->Cat_Mue = Yii::app()->request->getParam('Cat_Mue');
        $model->Sca_Mue = Yii::app()->request->getParam('Sca_Mue');
        $model->Des_Mue = Yii::app()->request->getParam('Des_Mue');
        $model->Med_Mue = Yii::app()->request->getParam('Med_Mue');
        $model->Col_Mue = Yii::app()->request->getParam('Col_Mue');
        $model->Pro_Mue = Yii::app()->request->getParam('Pro_Mue');
        $model->Pco_Mue = Yii::app()->request->getParam('Pco_Mue');
        $model->Uti_Mue = Yii::app()->request->getParam('Uti_Mue');
        $model->Pre_Mue = Yii::app()->request->getParam('Pre_Mue');

        $directorio = Yii::app()->getBasePath() . '/runtime/productos/';

        if ($_FILES["Im1_Mue"]):
            $imgInfo = pathinfo($_FILES["Im1_Mue"] ['name']);
            $imgName1 = $imgInfo['basename'];
            $model->Im1_Mue = $imgName1;

            if ($model->Im1_Mue):
                $imgName1 = $model->Cod_Mue . '-1.jpg';
                $model->Im1_Mue = $imgName1;
                if (move_uploaded_file($_FILES['Im1_Mue']['tmp_name'], $directorio . $imgName1)):
                    $norig = strtolower($_FILES['Im1_Mue']['name']);
                    $nombre = str_replace('.jpg', '', $norig);
                endif;
            endif;
        endif;

        if ($_FILES["Im2_Mue"]):
            $imgInfo = pathinfo($_FILES["Im2_Mue"] ['name']);
            $imgName2 = $imgInfo['basename'];
            $model->Im2_Mue = $imgName2;

            if ($model->Im2_Mue):
                $imgName2 = $model->Cod_Mue . '-2.jpg';
                $model->Im2_Mue = $imgName2;
                if (move_uploaded_file($_FILES['Im2_Mue']['tmp_name'], $directorio . $imgName2)):
                    $norig = strtolower($_FILES['Im2_Mue']['name']);
                    $nombre = str_replace('.jpg', '', $norig);
                endif;
            endif;
        endif;

        if ($_FILES["Im3_Mue"]):
            $imgInfo = pathinfo($_FILES["Im3_Mue"] ['name']);
            $imgName3 = $imgInfo['basename'];
            $model->Im3_Mue = $imgName3;

            if ($model->Im3_Mue):
                $imgName3 = $model->Cod_Mue . '-3.jpg';
                $model->Im3_Mue = $imgName3;
                if (move_uploaded_file($_FILES['Im3_Mue']['tmp_name'], $directorio . $imgName3)):
                    $norig = strtolower($_FILES['Im3_Mue']['name']);
                    $nombre = str_replace('.jpg', '', $norig);
                endif;
            endif;
        endif;

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            Consultas::insertProducto($model->Cod_Mue, $model->Nom_Mue, $model->Des_Mue, $model->Med_Mue, $model->Col_Mue, $model->Pro_Mue, $model->Pco_Mue, $model->Uti_Mue, $model->Pre_Mue, $model->Im1_Mue, $model->Im2_Mue, $model->Im3_Mue, $model->Cat_Mue, $model->Sca_Mue);
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionInsertarProveedor()
    {

        $model = new frm_proveedores();
        $model->Nom_Prov = Yii::app()->request->getParam('Nom_Prov');
        $model->Loc_Prov = Yii::app()->request->getParam('Loc_Prov');
        $model->Pro_Prov = Yii::app()->request->getParam('Pro_Prov');
        $model->Ref_Prov = Yii::app()->request->getParam('Ref_Prov');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            Consultas::insertProveedor($model->Nom_Prov, $model->Loc_Prov, $model->Pro_Prov, $model->Ref_Prov);
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionModificarProveedor()
    {
        $model = new frm_proveedores();

        $id = Yii::app()->request->getParam('Id_Prov');
        $model->Nom_Prov = Yii::app()->request->getParam('Nom_Prov');
        $model->Loc_Prov = Yii::app()->request->getParam('Loc_Prov');
        $model->Pro_Prov = Yii::app()->request->getParam('Pro_Prov');
        $model->Ref_Prov = Yii::app()->request->getParam('Ref_Prov');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            Consultas::updateProveedor($id, $model->Nom_Prov, $model->Loc_Prov, $model->Pro_Prov, $model->Ref_Prov);
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionModificarProducto()
    {
        $model = new frm_productos();

        $id = Yii::app()->request->getParam('Id_Mue');
        $model->Cod_Mue = Yii::app()->request->getParam('Cod_Mue');
        $model->Nom_Mue = Yii::app()->request->getParam('Nom_Mue');
        $model->Des_Mue = Yii::app()->request->getParam('Des_Mue');
        $model->Cat_Mue = Yii::app()->request->getParam('Cat_Mue');
        $model->Sca_Mue = Yii::app()->request->getParam('Sca_Mue');
        $model->Med_Mue = Yii::app()->request->getParam('Med_Mue');
        $model->Col_Mue = Yii::app()->request->getParam('Col_Mue');
        $model->Pro_Mue = Yii::app()->request->getParam('Pro_Mue');
        $model->Pco_Mue = Yii::app()->request->getParam('Pco_Mue');
        $model->Uti_Mue = Yii::app()->request->getParam('Uti_Mue');
        $model->Pre_Mue = Yii::app()->request->getParam('Pre_Mue');
        /*$model->Im1_Mue = Yii::app()->request->getParam('Im1_Mue');
        $model->Im2_Mue = Yii::app()->request->getParam('Im2_Mue');
        $model->Im3_Mue = Yii::app()->request->getParam('Im3_Mue');*/

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            Consultas::updateProducto($id, $model->Nom_Mue, $model->Des_Mue, $model->Med_Mue, $model->Col_Mue, $model->Pro_Mue, $model->Pco_Mue, $model->Uti_Mue, $model->Pre_Mue/*, $model->Im1_Mue, $model->Im2_Mue, $model->Im3_Mue*/, $model->Cat_Mue, $model->Sca_Mue);
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionEliminarProveedor()
    {
        $Id_Prov = Yii::app()->request->getParam('Id_Prov');
        if ($Id_Prov):
            $prod = Consultas::deleteProveedores($Id_Prov);
            echo CJSON::encode(true);
        endif;
    }

    public function actionAjaxValidaLogin()
    {
        $model = new Login_Mdl();

        $model->username = Yii::app()->request->getParam('username');
        $model->password = Yii::app()->request->getParam('password');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}

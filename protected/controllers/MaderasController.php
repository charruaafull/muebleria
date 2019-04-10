<?php

class MaderasController extends Controller
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
                'actions' => array(),
                'users' => array('*'),
            ),
            //TODAS LAS ACCIONES CON ACCESO PARA TODOS LOS USUARIOS LOGGEADOS //
            array('allow',
                'actions' => array(),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array(
                    'Index',
                    'InsertarMadera',
                    'UpdateMadera',
                    'DeleteMadera',
                    'GetSubSubcategorias'
                ),
                'expression' => "Yii::app()->session['USU']", // Yii::app()->session['USU']['Per_Usu']==1
            ),
            //NEGAMOS TODOS LOS USUARIOS
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $Id_Mad = Yii::app()->request->getParam('upd');
        $subcat = CrudCategorias::getSubCategorias();
        if (isset($Id_Mad)):
            $pro = CrudMaderas::getMadera($Id_Mad);
            $this->render('index', array('pro' => $pro, 'subcat' => $subcat));
        else:
            $res = CrudMaderas::getMaderas();
            $this->render('index', array('res' => $res, 'subcat' => $subcat));
        endif;
    }

    public function actionInsertarMadera()
    {

        $model = new frm_maderas();
        $model->Cod_Mad = Yii::app()->request->getParam('Cod_Mad');
        $model->Sub_Mad = Yii::app()->request->getParam('Sub_Mad');
        $model->Ssc_Mad = Yii::app()->request->getParam('Ssc_Mad');
        $model->Tce_Mad = Yii::app()->request->getParam('Tce_Mad');
        $model->Stc_Mad = Yii::app()->request->getParam('Stc_Mad');
        $model->Prc_Mad = Yii::app()->request->getParam('Prc_Mad');
        $model->Prp_Mad = Yii::app()->request->getParam('Prp_Mad');

        $directorio = Yii::app()->getBasePath() . '/runtime/productos/';

        if ($_FILES["Img_Mad"]):
            $imgInfo = pathinfo($_FILES["Img_Mad"] ['name']);
            $imgName1 = $imgInfo['basename'];
            $model->Img_Mad = $imgName1;

            if ($model->Img_Mad):
                $imgName1 = $model->Cod_Mad . '-1.jpg';
                $model->Img_Mad = $imgName1;
            endif;
        endif;

        if ($model->validate()):
            if (move_uploaded_file($_FILES['Img_Mad']['tmp_name'], $directorio . $imgName1)):
                $norig = strtolower($_FILES['Img_Mad']['name']);
                $nombre = str_replace('.jpg', '', $norig);
            endif;
            $res = array(
                'error' => false,
            );
            CrudMaderas::insert($model->Cod_Mad, $model->Img_Mad, $model->Sub_Mad, $model->Ssc_Mad, $model->Tce_Mad, $model->Stc_Mad, $model->Prc_Mad, $model->Prp_Mad);
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionDeleteMadera()
    {
        $Id_Mad = Yii::app()->request->getParam('Id_Mad');
        if ($Id_Mad):
            $prd = CrudMaderas::getMadera($Id_Mad);
            $prod = CrudMaderas::delete($Id_Mad);
            if ($prd['Img_Mad']):
                unlink(Yii::app()->getBasePath() . '/runtime/productos/' . $prd['Img_Mad']);
            endif;
            echo CJSON::encode(true);
        endif;
    }

    public function actionUpdateMadera()
    {

        $model = new frm_maderas();
        $id = Yii::app()->request->getParam('Id_Mad');
        $model->Cod_Mad = Yii::app()->request->getParam('Cod_Mad');
        $model->Img_Mad = Yii::app()->request->getParam('Img_Mad');
        $model->Sub_Mad = Yii::app()->request->getParam('Sub_Mad');
        $model->Ssc_Mad = Yii::app()->request->getParam('Ssc_Mad');
        $model->Tce_Mad = Yii::app()->request->getParam('Tce_Mad');
        $model->Stc_Mad = Yii::app()->request->getParam('Stc_Mad');
        $model->Prc_Mad = Yii::app()->request->getParam('Prc_Mad');
        $model->Prp_Mad = Yii::app()->request->getParam('Prp_Mad');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            CrudMaderas::update($id, $model->Img_Mad, $model->Sub_Mad, $model->Ssc_Mad, $model->Tce_Mad, $model->Stc_Mad, $model->Prc_Mad, $model->Prp_Mad);
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionGetSubSubcategorias()
    {
        $Id_Sma = Yii::app()->request->getParam('Id_Sma');
        if (isset($Id_Sma)):
            $res = CrudCategorias::getSubSubCategorias($Id_Sma);
            echo CJSON::encode($res);
        endif;
    }

}

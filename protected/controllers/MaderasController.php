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
                    'GetSubSubcategorias',
                    'InsertarTipoCepillado',
                    'DeleteTipoCepillado',
                    'UpdateTipoCepillado',
                    'TiposCepillados',
                    'InsertarSubTipoCepillado',
                    'DeleteSubTipoCepillado',
                    'UpdateSubTipoCepillado',
                    'SubTiposCepillados',
                    'ListaMaderas',
                    'AjaxSugerirCodigos'
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
            $codigos = CrudMaderas::getCodigos($_GET['q']);
            if (isset($_GET['jui'])):
                $res = array();
                foreach ($codigos as $p):
                    $res[] = array(
                        'value' => strtoupper($p['Cod_Mad']),
                        'cod' => $p['Cod_Mad'],
                        'id' => $p['Id_Mad'],
                    );
                endforeach;
                echo CJSON::encode($res);
            endif;
        endif;
    }

    public function actionListaMaderas()
    {
        $this->pageTitle = 'Listado de Maderas | ' . Yii::app()->name;
        $subcat = CrudCategorias::getSubCategorias();
        $cep = CrudCategorias::getTiposCepillado();
        $sce = CrudCategorias::getSubTipoCepillados();

        if (Yii::app()->request->getParam('search')):
            $Id_Mad = Yii::app()->request->getParam('Id_Mad');
            $Sub_Mad = Yii::app()->request->getParam('Sub_Mad');
            $Ssc_Mad = Yii::app()->request->getParam('Ssc_Mad');
            $Tce_Mad = Yii::app()->request->getParam('Tce_Mad');
            $Stc_Mad = Yii::app()->request->getParam('Stc_Mad');
            $pro = CrudMaderas::getAllMaderas($Id_Mad, $Sub_Mad, $Ssc_Mad, $Tce_Mad, $Stc_Mad);
            $this->render('list-mad', array('pro' => $pro, 'cep' => $cep, 'sce' => $sce, 'subcat' => $subcat));
            Yii::app()->end();
        endif;
        $this->render('list-mad', array('subcat' => $subcat, 'cep' => $cep, 'sce' => $sce));
    }

    public function actionIndex()
    {
        $Id_Mad = Yii::app()->request->getParam('upd');
        $subcat = CrudCategorias::getSubCategorias();
        $cep = CrudCategorias::getTiposCepillado();
        $sce = CrudCategorias::getSubTipoCepillados();
        if (isset($Id_Mad)):
            $pro = CrudMaderas::getMadera($Id_Mad);
            $this->render('index', array('pro' => $pro, 'cep' => $cep, 'sce' => $sce, 'subcat' => $subcat));
        else:
            $res = CrudMaderas::getMaderas();
            $this->render('index', array('res' => $res, 'subcat' => $subcat, 'cep' => $cep, 'sce' => $sce));
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


        $model->Pm2_Car_Mad = Yii::app()->request->getParam('Pm2_Car_Mad');
        $model->Pli_Car_Mad = Yii::app()->request->getParam('Pli_Car_Mad');
        $model->Ppi_Car_Mad = Yii::app()->request->getParam('Ppi_Car_Mad');
        $model->Pm2_Par_Mad = Yii::app()->request->getParam('Pm2_Par_Mad');
        $model->Pli_Par_Mad = Yii::app()->request->getParam('Pli_Par_Mad');
        $model->Ppi_Par_Mad = Yii::app()->request->getParam('Ppi_Par_Mad');

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
            CrudMaderas::insert($model->Cod_Mad, $model->Img_Mad, $model->Sub_Mad, $model->Ssc_Mad, $model->Tce_Mad, $model->Stc_Mad, $model->Pm2_Car_Mad, $model->Pli_Car_Mad, $model->Ppi_Car_Mad, $model->Pm2_Par_Mad, $model->Pli_Par_Mad, $model->Ppi_Par_Mad);
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
        $model->Pm2_Car_Mad = Yii::app()->request->getParam('Pm2_Car_Mad');
        $model->Pli_Car_Mad = Yii::app()->request->getParam('Pli_Car_Mad');
        $model->Ppi_Car_Mad = Yii::app()->request->getParam('Ppi_Car_Mad');
        $model->Pm2_Par_Mad = Yii::app()->request->getParam('Pm2_Par_Mad');
        $model->Pli_Par_Mad = Yii::app()->request->getParam('Pli_Par_Mad');
        $model->Ppi_Par_Mad = Yii::app()->request->getParam('Ppi_Par_Mad');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            CrudMaderas::update($id, $model->Img_Mad, $model->Sub_Mad, $model->Ssc_Mad, $model->Tce_Mad, $model->Stc_Mad, $model->Pm2_Car_Mad, $model->Pli_Car_Mad, $model->Ppi_Car_Mad, $model->Pm2_Par_Mad, $model->Pli_Par_Mad, $model->Ppi_Par_Mad);
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


    /*
     * Cepillado
     */

    public function actionInsertarTipoCepillado()
    {

        $model = new frm_tipocepillado();
        $id = (Yii::app()->request->getParam('Id_Cep')) ? Yii::app()->request->getParam('Id_Cep') : '';
        $model->Nom_Cep = Yii::app()->request->getParam('Nom_Cep');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            if ($id):
                CrudCategorias::updateTipoCepillado($id, $model->Nom_Cep);
            else:
                CrudCategorias::insertTipoCepillado($model->Nom_Cep);
            endif;
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionDeleteTipoCepillado()
    {
        $Id_Cep = Yii::app()->request->getParam('Id_Cep');
        if ($Id_Cep):
            $del = CrudCategorias::deleteTipoCepillado($Id_Cep);
            echo CJSON::encode(true);
        endif;
    }

    public function actionTiposCepillados()
    {
        $Id_Cep = Yii::app()->request->getParam('upd');
        if (isset($Id_Cep)):
            $cep = CrudCategorias::getTipoCepillado($Id_Cep);
            $this->render('tiposCepillado', array('cep' => $cep));
        else:
            $res = CrudCategorias::getTiposCepillado();
            $this->render('tiposCepillado', array('res' => $res));
        endif;
    }


    /*
    * SubTIpoCepillado
    */

    public function actionInsertarSubTipoCepillado()
    {

        $model = new frm_subtipocepillado();
        $id = (Yii::app()->request->getParam('Id_Sce')) ? Yii::app()->request->getParam('Id_Sce') : '';
        $model->Nom_Sce = Yii::app()->request->getParam('Nom_Sce');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            if ($id):
                CrudCategorias::updateSubTipoCepillado($id, $model->Nom_Sce);
            else:
                CrudCategorias::insertSubTipoCepillado($model->Nom_Sce);
            endif;
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    public function actionDeleteSubTipoCepillado()
    {
        $Id_Sce = Yii::app()->request->getParam('Id_Sce');
        if ($Id_Sce):
            $del = CrudCategorias::deleteSubTipoCepillado($Id_Sce);
            echo CJSON::encode(true);
        endif;
    }

    public function actionSubTiposCepillados()
    {
        $Id_Sce = Yii::app()->request->getParam('upd');
        if (isset($Id_Sce)):
            $sce = CrudCategorias::getSubTipoCepillado($Id_Sce);
            $this->render('subTiposCepillado', array('sce' => $sce));
        else:
            $res = CrudCategorias::getSubTipoCepillados();
            $this->render('subTiposCepillado', array('res' => $res));
        endif;
    }

}

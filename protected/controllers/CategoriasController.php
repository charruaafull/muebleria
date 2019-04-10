<?php

class CategoriasController extends Controller
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
                    'Subcategorias',
                    'InsertarSubcategoria',
                    'EliminarSubcategoria',
                    'MadSubSubCategorias',
                    'InsertarSubSubcategoria',
                    'EliminarSubSubcategoria'
                ),
                'expression' => "Yii::app()->session['USU']", // Yii::app()->session['USU']['Per_Usu']==1
            ),
            //NEGAMOS TODOS LOS USUARIOS
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionMadSubcategorias()
    {
        $Id_Mad = Yii::app()->request->getParam('upd');
        if (isset($Id_Mad)):
            $sma = CrudCategorias::getSubcategoria($Id_Mad);
            $this->render('subcategorias', array('sma' => $sma));
        else:
            $res = CrudCategorias::getSubCategorias();
            $this->render('subcategorias', array('res' => $res));
        endif;
    }

    public function actionEliminarSubcategoria()
    {
        $Id_Sma = Yii::app()->request->getParam('Id_Sma');
        if ($Id_Sma):
            $sma = CrudCategorias::delete($Id_Sma);
            echo CJSON::encode(true);
        endif;
    }

    public function actionInsertarSubcategoria()
    {

        $model = new frm_subcategoria_maderas();
        $id = (Yii::app()->request->getParam('Id_Sma')) ? Yii::app()->request->getParam('Id_Sma') : '';
        $model->Nom_Sma = Yii::app()->request->getParam('Nom_Sma');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            if ($id):
                CrudCategorias::update($id, $model->Nom_Sma);
            else:
                CrudCategorias::insert($model->Nom_Sma);
            endif;
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

    /*
     * Subcategorias
     */

    public function actionSubsubcategorias()
    {
        $Id_Ssm = Yii::app()->request->getParam('upd');
        $subcat = CrudCategorias::getSubCategorias();
        if (isset($Id_Ssm)):
            $ssm = CrudCategorias::getSubSubcategoria($Id_Ssm);
            $this->render('subsubcategorias', array('ssm' => $ssm, 'subcat' => $subcat));
        else:
            $res = CrudCategorias::getSubSubCategorias();
            $this->render('subsubcategorias', array('res' => $res, 'subcat' => $subcat));
        endif;
    }

    public function actionEliminarSubsubcategoria()
    {
        $Id_Ssm = Yii::app()->request->getParam('Id_Ssm');
        if ($Id_Ssm):
            $sma = CrudCategorias::deleteSubSubcategoria($Id_Ssm);
            echo CJSON::encode(true);
        endif;
    }

    public function actionInsertarSubsubcategoria()
    {

        $model = new frm_subsubcategoria_maderas();
        $id = (Yii::app()->request->getParam('Id_Ssm')) ? Yii::app()->request->getParam('Id_Ssm') : '';
        $model->Nom_Ssm = Yii::app()->request->getParam('Nom_Ssm');
        $model->Sma_Ssm = Yii::app()->request->getParam('Sma_Ssm');

        if ($model->validate()):
            $res = array(
                'error' => false,
            );
            if ($id):
                CrudCategorias::updateSubSubcategoria($id, $model->Nom_Ssm, $model->Sma_Ssm);
            else:
                CrudCategorias::insertSubSubcategoria($model->Nom_Ssm, $model->Sma_Ssm);
            endif;
        else:
            $res = array(
                'error' => true,
                'info' => $model->errors,
            );
        endif;

        echo CJSON::encode($res);
    }

}

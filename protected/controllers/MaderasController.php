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
                    'Index'
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
        $this->render('index');
    }

}

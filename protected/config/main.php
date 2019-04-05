<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Gestión Echeverría Maderas',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(),
    // application components
    'components' => array(
        'user' => array(
            'loginUrl' => array('login'),
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'caseSensitive' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/<view>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'Productos' => 'site/Productos',
                'Login' => 'site/Login',
                'AjaxValidaLogin' => 'site/AjaxValidaLogin',
                'Logout' => 'site/Logout',
                'InsertarProducto' => 'site/InsertarProducto',
                'ModificarProducto' => 'site/ModificarProducto',
                'ListarProductos' => 'site/ListarProductos',
                'EliminarProducto' => 'site/EliminarProducto',
                'Proveedores' => 'site/Proveedores',
                'InsertarProveedor' => 'site/InsertarProveedor',
                'ModificarProveedor' => 'site/ModificarProveedor',
                'EliminarProveedor' => 'site/EliminarProveedor',
                'GetLocalidades' => 'site/GetLocalidades',
                'Subcategorias' => 'site/Subcategorias',
                'InsertarSubcategoria' => 'site/InsertarSubcategoria',
                'ModificarSubcategoria' => 'site/ModificarSubcategoria',
                'EliminarSubcategoria' => 'site/EliminarSubcategoria',
                'GetSubcategorias' => 'site/GetSubcategorias',
                'AjaxSugerirCodigos' => 'site/AjaxSugerirCodigos',
                'AjaxSugerirNombres' => 'site/AjaxSugerirNombres',
                'AjaxSugerirProveedores' => 'site/AjaxSugerirProveedores'
            ),
        ),
        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => YII_DEBUG ? null : 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'mail@info.com',
    ),
    'language' => 'es',
    'sourceLanguage' => 'es',
    'timeZone' => 'America/Argentina/Buenos_Aires',
);

<?php

class sistema
{

    public static function getFilas($sql)
    {
        $command = Yii::app()->db->createCommand($sql);
        $results = $command->queryAll();
        return $results;
    }

    public static function getFila($sql)
    {
        $command = Yii::app()->db->createCommand($sql);
        $results = $command->queryRow();
        return $results;
    }

    public static function getCampo($sql)
    {
        $command = Yii::app()->db->createCommand($sql);
        $results = $command->queryAll();
        return $results[0];
    }

    public static function execute($sql)
    {
        $command = Yii::app()->db->createCommand($sql);
        $results = $command->execute();
        return $results[0];
    }

    public static function generarCodigo()
    {
        $valido = 0;
        for ($i = 0; $i < 10; $i++):
            $cod = str_pad(rand(0, 999999999), 10, "0", STR_PAD_LEFT);
            $valido = Consultas::validaCodigo($cod);
            if ($valido['tot'] == 0):
                return $cod;
            endif;
        endfor;
    }

}

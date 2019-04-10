<?php

class CrudCategorias
{

    public static function getSubCategorias()
    {
        $sql = "Select * From subcat_maderas ";

        return sistema::getFilas($sql);
    }

    public static function delete($Id_Sma)
    {
        $sql = "Delete From subcat_maderas Where Id_Sma = $Id_Sma";
        return sistema::execute($sql);
    }

    public static function getSubcategoria($Id_Sma)
    {
        $sql = "Select * From subcat_maderas Where Id_Sma = $Id_Sma";
        return sistema::getFila($sql);
    }

    public static function insert($Nom_Sma)
    {
        $sql = "Insert Into subcat_maderas " .
            "(" .
            "Nom_Sma" .
            ") " .
            "VALUES " .
            "(" .
            "'$Nom_Sma'" .
            ")";

        return sistema::execute($sql);
    }

    public static function update($id, $Nom_Sma)
    {
        $sql = "Update subcat_maderas set "
            . "Nom_Sma = '$Nom_Sma' " .
            "Where Id_Sma = $id";
        return sistema::execute($sql);
    }


    public static function getSubSubCategorias($id = '')
    {
        $sql = "Select * From subsub_maderas " .
            "join subcat_maderas On Id_Sma = Sma_Ssm ";

        if ($id):
            $sql .= "Where Sma_Ssm = $id ";
        endif;

        return sistema::getFilas($sql);
    }

    public static function deleteSubSubcategoria($Id_Ssm)
    {
        $sql = "Delete From subsub_maderas Where Id_Ssm = $Id_Ssm";
        return sistema::execute($sql);
    }

    public static function getSubSubcategoria($Id_Ssm)
    {
        $sql = "Select * From subsub_maderas Where Id_Ssm = $Id_Ssm";
        return sistema::getFila($sql);
    }

    public static function insertSubSubcategoria($Nom_Ssm, $Sma_Ssm)
    {
        $sql = "Insert Into subsub_maderas " .
            "(" .
            "Sma_Ssm," .
            "Nom_Ssm" .
            ") " .
            "VALUES " .
            "(" .
            "$Sma_Ssm," .
            "'$Nom_Ssm'" .
            ")";

        return sistema::execute($sql);
    }

    public static function updateSubSubcategoria($id, $Nom_Ssm, $Sma_Ssm)
    {
        $sql = "Update subsub_maderas set "
            . "Sma_Ssm = $Sma_Ssm , "
            . "Nom_Ssm = '$Nom_Ssm' "
            . "Where Id_Ssm = $id";
        return sistema::execute($sql);
    }

}

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

    /*
     * Cepillado
     */

    public static function getTiposCepillado()
    {
        $sql = "Select * From tipocepillado_maderas ";
        return sistema::getFilas($sql);
    }

    public static function deleteTipoCepillado($Id_Cep)
    {
        $sql = "Delete From tipocepillado_maderas Where Id_Cep = $Id_Cep";
        return sistema::execute($sql);
    }

    public static function getTipoCepillado($Id_Cep)
    {
        $sql = "Select * From tipocepillado_maderas Where Id_Cep = $Id_Cep";
        return sistema::getFila($sql);
    }

    public static function insertTipoCepillado($Nom_Cep)
    {
        $sql = "Insert Into tipocepillado_maderas " .
            "(" .
            "Nom_Cep" .
            ") " .
            "VALUES " .
            "(" .
            "'$Nom_Cep'" .
            ")";

        return sistema::execute($sql);
    }

    public static function updateTipoCepillado($id, $Nom_Cep)
    {
        $sql = "Update tipocepillado_maderas set "
            . "Nom_Cep = '$Nom_Cep' " .
            "Where Id_Cep = $id";
        return sistema::execute($sql);
    }

    /*
     * Subtipo cepillados
     */

    public static function getSubTipoCepillados($id = '')
    {
        $sql = "Select * From subtipocepillado_maderas ";
        return sistema::getFilas($sql);
    }

    public static function deleteSubTipoCepillado($Id_Sce)
    {
        $sql = "Delete From subtipocepillado_maderas Where Id_Sce = $Id_Sce";
        return sistema::execute($sql);
    }

    public static function getSubTipoCepillado($Id_Sce)
    {
        $sql = "Select * From subtipocepillado_maderas Where Id_Sce = $Id_Sce";
        return sistema::getFila($sql);
    }

    public static function insertSubTipoCepillado($Nom_Sce)
    {
        $sql = "Insert Into subtipocepillado_maderas " .
            "(" .
            "Nom_Sce" .
            ") " .
            "VALUES " .
            "(" .
            "'$Nom_Sce'" .
            ")";

        return sistema::execute($sql);
    }

    public static function updateSubTipoCepillado($id, $Nom_Sce)
    {
        $sql = "Update subtipocepillado_maderas set "
            . "Nom_Sce = '$Nom_Sce' "
            . "Where Id_Sce = $id";
        return sistema::execute($sql);
    }

}

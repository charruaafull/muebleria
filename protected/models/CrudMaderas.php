<?php

class CrudMaderas
{

    public static function getMaderas()
    {
        $sql = "Select * From maderas ";

        return sistema::getFilas($sql);
    }

    public static function delete($Id_Mad)
    {
        $sql = "Delete From maderas Where Id_Mad = $Id_Mad";
        return sistema::execute($sql);
    }

    public static function getMadera($Id_Mad)
    {
        $sql = "Select * From maderas Where Id_Mad = $Id_Mad";
        return sistema::getFila($sql);
    }

    public static function insert($Cod_Mad, $Img_Mad, $Sub_Mad, $Ssc_Mad, $Tce_Mad, $Stc_Mad, $Prc_Mad, $Prp_Mad)
    {
        $sql = "Insert Into maderas " .
            "(" .
            "Cod_Mad," .
            "Img_Mad," .
            "Sub_Mad," .
            "Ssc_Mad," .
            "Tce_Mad," .
            "Stc_Mad," .
            "Prc_Mad," .
            "Prp_Mad" .
            ") " .
            "VALUES " .
            "(" .
            "$Cod_Mad," .
            "'$Img_Mad'," .
            "$Sub_Mad," .
            "$Ssc_Mad," .
            "$Tce_Mad," .
            "$Stc_Mad," .
            "$Prc_Mad," .
            "$Prp_Mad" .
            ")";

        return sistema::execute($sql);
    }

    public static function update($id, $Img_Mad, $Sub_Mad, $Ssc_Mad, $Tce_Mad, $Stc_Mad, $Prc_Mad, $Prp_Mad)
    {
        $sql = "Update maderas set ";

        if ($Img_Mad):
            $sql.= "Img_Mad = '$Img_Mad',";
        endif;

        $sql .= "Sub_Mad = $Sub_Mad," .
            "Ssc_Mad = $Ssc_Mad," .
            "Tce_Mad = $Tce_Mad," .
            "Stc_Mad = $Stc_Mad," .
            "Prc_Mad = $Prc_Mad," .
            "Prp_Mad = $Prp_Mad " .
            "Where Id_Mad = $id";

        return sistema::execute($sql);
    }

}

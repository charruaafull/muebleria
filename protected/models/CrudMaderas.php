<?php

class CrudMaderas
{

    public static function getCodigo($cod)
    {
        $sql = "Select count(*) tot From maderas Where Cod_Mad = $cod";
        $res = sistema::getFila($sql);
        $tot = $res['tot'];
        return $tot;
    }

    public static function getMaderas()
    {
        $sql = "Select * From maderas "
            . "left join subcat_maderas on Id_Sma = Sub_Mad "
            . "left join subsub_maderas on Id_Ssm = Ssc_Mad "
            . "left join tipocepillado_maderas on Id_Cep = Tce_Mad "
            . "left join subtipocepillado_maderas on Id_Sce = Stc_Mad ";

        return sistema::getFilas($sql);
    }

    public static function delete($Id_Mad)
    {
        $sql = "Delete From maderas Where Id_Mad = $Id_Mad";
        return sistema::execute($sql);
    }

    public static function getMadera($Id_Mad)
    {
        $sql = "Select * From maderas "
            . " Where Id_Mad = $Id_Mad";
        return sistema::getFila($sql);
    }

    public static function insert($Cod_Mad, $Img_Mad, $Sub_Mad, $Ssc_Mad, $Tce_Mad, $Stc_Mad, $Pm2_Car_Mad, $Pli_Car_Mad, $Ppi_Car_Mad, $Pm2_Par_Mad, $Pli_Par_Mad, $Ppi_Par_Mad)
    {
        $sql = "Insert Into maderas " .
            "(" .
            "Cod_Mad," .
            "Img_Mad," .
            "Sub_Mad," .
            "Ssc_Mad," .
            "Tce_Mad," .
            "Stc_Mad," .
            "Pm2_Car_Mad," .
            "Pli_Car_Mad," .
            "Ppi_Car_Mad," .
            "Pm2_Par_Mad," .
            "Pli_Par_Mad," .
            "Ppi_Par_Mad" .
            ") " .
            "VALUES " .
            "(" .
            "$Cod_Mad," .
            "'$Img_Mad'," .
            "$Sub_Mad," .
            "$Ssc_Mad," .
            "$Tce_Mad," .
            "$Stc_Mad," .
            "$Pm2_Car_Mad," .
            "$Pli_Car_Mad," .
            "$Ppi_Car_Mad," .
            "$Pm2_Par_Mad," .
            "$Pli_Par_Mad," .
            "$Ppi_Par_Mad" .
            ")";

        return sistema::execute($sql);
    }

    public static function update($id, $Img_Mad, $Sub_Mad, $Ssc_Mad, $Tce_Mad, $Stc_Mad, $Pm2_Car_Mad, $Pli_Car_Mad, $Ppi_Car_Mad, $Pm2_Par_Mad, $Pli_Par_Mad, $Ppi_Par_Mad)
    {
        $sql = "Update maderas set ";

        if ($Img_Mad):
            $sql .= "Img_Mad = '$Img_Mad',";
        endif;

        $sql .= "Sub_Mad = $Sub_Mad," .
            "Ssc_Mad = $Ssc_Mad," .
            "Tce_Mad = $Tce_Mad," .
            "Stc_Mad = $Stc_Mad," .
            "Pm2_Car_Mad = $Pm2_Car_Mad," .
            "Pli_Car_Mad = $Pli_Car_Mad," .
            "Ppi_Car_Mad = $Ppi_Car_Mad," .
            "Pm2_Par_Mad = $Pm2_Par_Mad," .
            "Pli_Par_Mad = $Pli_Par_Mad," .
            "Ppi_Par_Mad = $Ppi_Par_Mad " .
            "Where Id_Mad = $id";

        return sistema::execute($sql);
    }

    public static function getCodigos($txt)
    {
        $sql = "Select * From maderas "
            . "Where Cod_Mad Like '$txt%' ";
        return sistema::getFilas($sql);
    }

    public static function getAllMaderas($Id_Mad = '', $Sub_Mad = '', $Ssc_Mad = '', $Tce_Mad = '', $Stc_Mad = '')
    {
        $sql = "Select * From maderas "
            . "left join subcat_maderas on Id_Sma = Sub_Mad "
            . "left join subsub_maderas on Id_Ssm = Ssc_Mad "
            . "left join tipocepillado_maderas on Id_Cep = Tce_Mad "
            . "left join subtipocepillado_maderas on Id_Sce = Stc_Mad "
            . "Where 1 = 1 ";

        if ($Id_Mad):
            $sql .= "and Id_Mad = $Id_Mad ";
        else:
            if ($Sub_Mad):
                $sql .= "and Sub_Mad = $Sub_Mad ";
            endif;
        endif;

        if ($Ssc_Mad):
            $sql .= "and Ssc_Mad = $Ssc_Mad ";
        endif;

        if ($Tce_Mad):
            $sql .= "and Tce_Mad = $Tce_Mad ";
        endif;

        if ($Stc_Mad):
            $sql .= "and Stc_Mad = $Stc_Mad ";
        endif;

//        var_dump($sql); exit();

        return sistema::getFilas($sql);
    }

}

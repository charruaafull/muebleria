<?php

class Consultas
{

    public static function getCuenta($username, $password)
    {
        $sql = "Select * From usu_tbl Where Use_Usu = '$username' and Psw_Usu = '$password'";
        return sistema::getFila($sql);
    }

    public static function getProducto($Id_Mue)
    {
        $sql = "Select * From productos Where Id_Mue = $Id_Mue";
        return sistema::getFila($sql);
    }

    public static function deleteProducto($Id_Mue)
    {
        $sql = "Delete From productos Where Id_Mue = $Id_Mue";
        return sistema::execute($sql);
    }

    public static function getProductos($Id_Mue = '', $Id_Prov = '', $Cat_Mue = '', $Sca_Mue = '')
    {
        $sql = "Select * From productos "
            . "Left join proveedores On Pro_Mue = Id_Prov "
            . "Left join subcategorias On Id_Sub = Sca_Mue " .
            "Where 1 = 1 ";

        if ($Id_Mue):
            $sql .= "and Id_Mue = $Id_Mue ";
        else:
            if ($Id_Prov):
                $sql .= "and Pro_Mue = $Id_Prov ";
            endif;
        endif;

        if ($Cat_Mue):
            $sql .= "and Cat_Mue = $Cat_Mue ";
        endif;

        if ($Sca_Mue):
            $sql .= "and Sca_Mue = $Sca_Mue ";
        endif;

        return sistema::getFilas($sql);
    }

    public static function getSubcategorias($Cat_Sub = '')
    {
        $sql = "Select * From subcategorias ";
        if ($Cat_Sub):
            $sql .= "Where Cat_Sub = $Cat_Sub";
        endif;
        return sistema::getFilas($sql);
    }

    public static function getSubcategoria($Id_Subc)
    {
        $sql = "Select * From subcategorias Where Id_Sub = $Id_Subc";
        return sistema::getFila($sql);
    }

    public static function getProveedores()
    {
        $sql = "Select * From proveedores " .
            "Join pro_tbl On Id_Pro = Pro_Prov " .
            "Join loc_tbl On Id_Loc = Loc_Prov ";
        return sistema::getFilas($sql);
    }

    public static function deleteProveedores($Id_Mue)
    {
        $sql = "Delete From proveedores Where Id_Prov = $Id_Mue";
        return sistema::execute($sql);
    }

    public static function getProveedor($Id_Prov)
    {
        $sql = "Select * From proveedores Where Id_Prov = $Id_Prov";
        return sistema::getFila($sql);
    }

    public static function insertProducto($Cod_Mue, $Nom_Mue, $Des_Mue, $Med_Mue, $Col_Mue, $Pro_Mue, $Pco_Mue, $Uti_Mue, $Pre_Mue, $Pr2_Mue, $Im1_Mue, $Im2_Mue, $Im3_Mue, $Cat_Mue, $Sca_Mue,$Out_Mue)
    {
        $sql = "Insert Into productos " .
            "(" .
            "Cod_Mue," .
            "Nom_Mue," .
            "Des_Mue," .
            "Med_Mue," .
            "Col_Mue," .
            "Pro_Mue," .
            "Pco_Mue," .
            "Uti_Mue," .
            "Pre_Mue," .
            "Pr2_Mue," .
            "Im1_Mue," .
            "Im2_Mue," .
            "Im3_Mue," .
            "Cat_Mue," .
            "Out_Mue," .
            "Sca_Mue" .
            ") " .
            "VALUES " .
            "(" .
            "'$Cod_Mue'," .
            "'$Nom_Mue'," .
            "'$Des_Mue'," .
            "'$Med_Mue'," .
            "'$Col_Mue'," .
            "$Pro_Mue," .
            "$Pco_Mue," .
            "$Uti_Mue," .
            "$Pre_Mue," .
            "$Pr2_Mue," .
            "'$Im1_Mue'," .
            "'$Im2_Mue'," .
            "'$Im3_Mue'," .
            "$Cat_Mue," .
            "$Out_Mue," .
            "$Sca_Mue" .
            ")";

        return sistema::execute($sql);
    }

    public static function insertProveedor($Nom_Prov, $Loc_Prov, $Pro_Prov, $Ref_Prov)
    {
        $sql = "Insert Into proveedores " .
            "(" .
            "Nom_Prov," .
            "Loc_Prov," .
            "Pro_Prov," .
            "Ref_Prov" .
            ") " .
            "VALUES " .
            "(" .
            "'$Nom_Prov'," .
            "$Loc_Prov," .
            "$Pro_Prov," .
            "'$Ref_Prov'" .
            ")";
        return sistema::execute($sql);
    }

    public static function insertSubcategoria($Cat_Sub, $Nom_Sub)
    {
        $sql = "Insert Into subcategorias " .
            "(" .
            "Cat_Sub," .
            "Nom_Sub" .
            ") " .
            "VALUES " .
            "(" .
            "'$Cat_Sub'," .
            "'$Nom_Sub'" .
            ")";
        return sistema::execute($sql);
    }

    public static function deleteSubcategoria($Id_Sub)
    {
        $sql = "Delete From subcategorias Where Id_Sub = $Id_Sub";
        return sistema::execute($sql);
    }

    public static function updateSubcategoria($id, $Cat_Sub, $Nom_Sub)
    {
        $sql = "Update subcategorias Set " .
            "Nom_Sub = '$Nom_Sub'," .
            "Cat_Sub = $Cat_Sub " .
            "Where Id_Sub = $id ";
        return sistema::execute($sql);
    }

    public static function updateProveedor($id, $Nom_Prov, $Loc_Prov, $Pro_Prov, $Ref_Prov)
    {
        $sql = "Update proveedores Set " .
            "Nom_Prov = '$Nom_Prov'," .
            "Loc_Prov = '$Loc_Prov'," .
            "Pro_Prov = '$Pro_Prov'," .
            "Ref_Prov = '$Ref_Prov' " .
            "Where Id_Prov = $id ";
        return sistema::execute($sql);
    }

    public static function updateProducto($id, $Nom_Mue, $Des_Mue, $Med_Mue, $Col_Mue, $Pro_Mue, $Pco_Mue, $Uti_Mue, $Pre_Mue,$Pr2_Mue/*, $Im1_Mue, $Im2_Mue, $Im3_Mue*/, $Cat_Mue, $Sca_Mue,$Out_Mue)
    {
        $sql = "Update productos Set " .
            "Nom_Mue = '$Nom_Mue'," .
            "Des_Mue = '$Des_Mue'," .
            "Med_Mue = '$Med_Mue'," .
            "Col_Mue = '$Col_Mue'," .
            "Pro_Mue = '$Pro_Mue'," .
            "Pco_Mue = $Pco_Mue," .
            "Uti_Mue = $Uti_Mue," .
            "Pre_Mue = $Pre_Mue," .
            "Pr2_Mue = $Pr2_Mue," .
            "Cat_Mue = $Cat_Mue," .
            "Out_Mue = $Out_Mue," .
            "Sca_Mue = $Sca_Mue " .
            /* "Im1_Mue = '$Im1_Mue'," .
             "Im2_Mue = '$Im2_Mue'," .
             "Im3_Mue = '$Im3_Mue' " .*/
            "Where Id_Mue = $id ";

        return sistema::execute($sql);
    }

    public static function validaCodigo($cod)
    {
        $sql = "Select count(*) tot From productos Where Cod_Mue = '$cod'";
        return sistema::getFila($sql);
    }

    public static function getProvincias()
    {
        $sql = "Select * From pro_tbl";
        return sistema::getFilas($sql);
    }

    public static function getLocalidades($pro)
    {
        $sql = "Select * From loc_tbl where Pro_Loc = $pro";
        return sistema::getFilas($sql);
    }

    public static function getLocalidad($loc)
    {
        $sql = "Select * From loc_tbl Where Id_Loc = $loc";
        $db = sistema::getFila($sql);
        return $db['Nom_Loc'];
    }

    public static function getProvincia($prov)
    {
        $sql = "Select Nom_Pro From pro_tbl Where Id_Pro = $prov";
        $db = sistema::getFila($sql);
        return $db['Nom_Pro'];
    }

    public static function getCodigos($txt)
    {
        $sql = "Select * From productos "
            . "Where Cod_Mue Like '$txt%' ";
        return sistema::getFilas($sql);
    }

    public static function getCodProveedores($txt)
    {
        $sql = "Select * From proveedores "
            . "Where Nom_Prov Like '$txt%' ";
        return sistema::getFilas($sql);
    }

    public static function getCodProducto($txt)
    {
        $sql = "Select * From productos "
            . "Where Nom_Mue Like '$txt%' ";
        return sistema::getFilas($sql);
    }

}

<?php

class frm_proveedores extends CFormModel
{

    public $Nom_Prov;
    public $Loc_Prov;
    public $Pro_Prov;
    public $Ref_Prov;

    public function rules()
    {

        return array(
            array('Nom_Prov', 'required'),
            array('Nom_Prov', 'encodingString'),
            array('Nom_Prov', 'length', 'max' => 50),

            array('Loc_Prov', 'required'),
            array('Loc_Prov', 'encodingString'),
            array('Loc_Prov', 'length', 'max' => 4),

            array('Pro_Prov', 'required'),
            array('Pro_Prov', 'encodingString'),
            array('Pro_Prov', 'length', 'max' => 3),

            array('Ref_Prov', 'encodingString'),
            array('Ref_Prov', 'length', 'max' => 600),
        );
    }

    public function attributeLabels()
    {
        return array(
            'Nom_Prov' => 'Nombre',
            'Loc_Prov' => 'Localidad',
            'Pro_Prov' => 'Provincia',
            'Ref_Prov' => 'Referencia'
        );
    }

    public function encodingString($attribute)
    {
        if ($this->$attribute != ''):
            $val = (preg_match('/"/i', $this->$attribute)) ? 1 : 0;
            if ($val):
                $this->addError($attribute, ' El campo no puede contener comillas.');
                exit();
            endif;
            $val = (preg_match("/'/i", $this->$attribute)) ? 1 : 0;
            if ($val):
                $this->addError($attribute, ' El campo no puede contener comillas.');
                exit();
            endif;
        endif;
    }

}

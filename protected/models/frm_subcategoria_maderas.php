<?php

class frm_subcategoria_maderas extends CFormModel
{

    public $Nom_Sma;

    public function rules()
    {

        return array(
            array('Nom_Sma', 'required'),
            array('Nom_Sma', 'encodingString'),
            array('Nom_Sma', 'length', 'max' => 40),
        );
    }

    public function attributeLabels()
    {
        return array(
            'Nom_Sma' => 'Subcategoría',
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

<?php

class frm_subsubcategoria_maderas extends CFormModel
{

    public $Nom_Ssm;
    public $Sma_Ssm;

    public function rules()
    {

        return array(
            array('Sma_Ssm', 'required'),
            array('Sma_Ssm', 'encodingString'),
            array('Sma_Ssm', 'length', 'max' => 3),

            array('Nom_Ssm', 'required'),
            array('Nom_Ssm', 'encodingString'),
            array('Nom_Ssm', 'length', 'max' => 40),
        );
    }

    public function attributeLabels()
    {
        return array(
            'Nom_Ssm' => 'Sub-Subcategoría',
            'Sma_Ssm' => 'Subcategoría',
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

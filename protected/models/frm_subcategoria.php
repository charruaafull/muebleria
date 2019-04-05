<?php

class frm_subcategoria extends CFormModel
{

    public $Cat_Sca;
    public $Nom_Sca;

    public function rules()
    {

        return array(
            array('Nom_Sca', 'required'),
            array('Nom_Sca', 'encodingString'),
            array('Nom_Sca', 'length', 'max' => 50),

            array('Cat_Sca', 'required'),
            array('Cat_Sca', 'encodingString'),
            array('Cat_Sca', 'length', 'max' => 4),
        );
    }

    public function attributeLabels()
    {
        return array(
            'Cat_Sca' => 'Categoría',
            'Nom_Sca' => 'Nombre',
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

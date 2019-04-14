<?php

class frm_tipocepillado extends CFormModel
{

    public $Nom_Cep;

    public function rules()
    {

        return array(
            array('Nom_Cep', 'required'),
            array('Nom_Cep', 'encodingString'),
            array('Nom_Cep', 'length', 'max' => 50),
        );
    }

    public function attributeLabels()
    {
        return array(
            'Nom_Cep' => 'Nombre',
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

<?php

class frm_subtipocepillado extends CFormModel
{

    public $Nom_Sce;

    public function rules()
    {

        return array(
            array('Nom_Sce', 'required'),
            array('Nom_Sce', 'encodingString'),
            array('Nom_Sce', 'length', 'max' => 50),
        );
    }

    public function attributeLabels()
    {
        return array(
            'Nom_Sce' => 'Nombre',
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

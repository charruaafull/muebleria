<?php

class frm_maderas extends CFormModel
{

    public $Cod_Mad;
    public $Img_Mad;
    public $Sub_Mad;
    public $Ssc_Mad;
    public $Tce_Mad;
    public $Stc_Mad;
    public $Prc_Mad;
    public $Prp_Mad;

    public function rules()
    {

        return array(
            array('Cod_Mad', 'required'),
            array('Cod_Mad', 'encodingString'),
            array('Cod_Mad', 'length', 'max' => 11),

            array('Img_Mad', 'encodingString'),
            array('Img_Mad', 'length', 'max' => 40),

            array('Sub_Mad', 'required'),
            array('Sub_Mad', 'encodingString'),
            array('Sub_Mad', 'length', 'max' => 4),

            array('Ssc_Mad', 'required'),
            array('Ssc_Mad', 'encodingString'),
            array('Ssc_Mad', 'length', 'max' => 4),

            array('Tce_Mad', 'required'),
            array('Tce_Mad', 'encodingString'),
            array('Tce_Mad', 'length', 'max' => 4),

            array('Stc_Mad', 'required'),
            array('Stc_Mad', 'encodingString'),
            array('Stc_Mad', 'length', 'max' => 4),

            array('Prc_Mad', 'required'),
            array('Prc_Mad', 'encodingString'),
            array('Prc_Mad', 'length', 'max' => 4),

            array('Prp_Mad', 'required'),
            array('Prp_Mad', 'encodingString'),
            array('Prp_Mad', 'length', 'max' => 4),
        );
    }

    public function attributeLabels()
    {
        return array(
            'Cod_Mad' => 'Código',
            'Img_Mad' => 'Imágen',
            'Sub_Mad' => 'Subcategoría',
            'Ssc_Mad' => 'Sub-Subcategoría',
            'Tce_Mad' => 'Tipo de cepillado',
            'Stc_Mad' => 'Subtipo de cepillado',
            'Prc_Mad' => 'Precio carpintero',
            'Prp_Mad' => 'Precio partcular',
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

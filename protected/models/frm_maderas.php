<?php

class frm_maderas extends CFormModel
{

    public $Cod_Mad;
    public $Img_Mad;
    public $Sub_Mad;
    public $Ssc_Mad;
    public $Tce_Mad;
    public $Stc_Mad;
    public $Pm2_Car_Mad;
    public $Pli_Car_Mad;
    public $Ppi_Car_Mad;
    public $Pm2_Par_Mad;
    public $Pli_Par_Mad;
    public $Ppi_Par_Mad;

    public function rules()
    {

        return array(
            array('Cod_Mad', 'required'),
            array('Cod_Mad', 'validoCodigo'),
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

            array('Pm2_Car_Mad', 'required'),
            array('Pli_Car_Mad', 'required'),
            array('Ppi_Car_Mad', 'required'),

            array('Pm2_Par_Mad', 'required'),
            array('Pli_Par_Mad', 'required'),
            array('Ppi_Par_Mad', 'required')

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
            'Pm2_Car_Mad' => 'Precio M2',
            'Pli_Car_Mad' => 'Precio Lineal',
            'Ppi_Car_Mad' => 'Precio Pie',
            'Pm2_Par_Mad' => 'Precio M2',
            'Pli_Par_Mad' => 'Precio Lineal',
            'Ppi_Par_Mad' => 'Precio Pie',
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

    public function validoCodigo($attribute)
    {
        if ($this->$attribute != ''):
            $res = CrudMaderas::getCodigo($this->$attribute);
            if ($res > 0):
                $this->addError($attribute, 'El código ya existe');
            endif;
        endif;
    }

}

<?php

class frm_productos extends CFormModel
{

    public $Cod_Mue;
    public $Nom_Mue;
    public $Cat_Mue;
    public $Sca_Mue;
    public $Des_Mue;
    public $Med_Mue;
    public $Col_Mue;
    public $Pro_Mue;
    public $Pco_Mue;
    public $Uti_Mue;
    public $Out_Mue;
    public $Pre_Mue;
    public $Pr2_Mue;
    public $Im1_Mue;
    public $Im2_Mue;
    public $Im3_Mue;

    public function rules()
    {

        return array(
            array('Cod_Mue', 'required'),
            array('Cod_Mue', 'validoCodigo'),
            array('Cod_Mue', 'encodingString'),
            array('Cod_Mue', 'length', 'max' => 12),

            array('Nom_Mue', 'required'),
            array('Nom_Mue', 'encodingString'),
            array('Nom_Mue', 'length', 'max' => 50),

            array('Cat_Mue', 'required'),
            array('Cat_Mue', 'encodingString'),
            array('Cat_Mue', 'length', 'max' => 4),

            array('Sca_Mue', 'required'),
            array('Sca_Mue', 'encodingString'),
            array('Sca_Mue', 'length', 'max' => 4),

            array('Des_Mue', 'required'),
            array('Des_Mue', 'encodingString'),
            array('Des_Mue', 'length', 'max' => 600),

            array('Med_Mue', 'required'),
            array('Med_Mue', 'encodingString'),
            array('Med_Mue', 'length', 'max' => 100),

            array('Col_Mue', 'required'),
            array('Col_Mue', 'encodingString'),
            array('Col_Mue', 'length', 'max' => 50),

            array('Pro_Mue', 'required'),
            array('Pro_Mue', 'encodingString'),
            array('Pro_Mue', 'length', 'max' => 3),

            array('Pco_Mue', 'required'),
            array('Pco_Mue', 'encodingString'),
            array('Pco_Mue', 'length', 'max' => 11),

            array('Uti_Mue', 'required'),
            array('Uti_Mue', 'encodingString'),
            array('Uti_Mue', 'length', 'max' => 11),

            array('Out_Mue', 'encodingString'),
            array('Out_Mue', 'length', 'max' => 11),

            array('Pre_Mue', 'required'),
            array('Pre_Mue', 'encodingString'),
            array('Pre_Mue', 'length', 'max' => 11),

            array('Pr2_Mue', 'required'),
            array('Pr2_Mue', 'encodingString'),
            array('Pr2_Mue', 'length', 'max' => 11),

            array('Im1_Mue', 'length', 'max' => 50),
            array('Im1_Mue', 'encodingString'),

            array('Im2_Mue', 'length', 'max' => 50),
            array('Im2_Mue', 'encodingString'),

            array('Im3_Mue', 'length', 'max' => 50),
            array('Im3_Mue', 'encodingString'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'Cod_Mue' => 'Código',
            'Nom_Mue' => 'Nombre',
            'Cat_Mue' => 'Categoría',
            'Sca_Mue' => 'Subcategoría',
            'Des_Mue' => 'Descripción',
            'Med_Mue' => 'Medidas',
            'Col_Mue' => 'Color',
            'Pro_Mue' => 'Proveedor',
            'Pco_Mue' => 'Precio Costo',
            'Uti_Mue' => 'Utilidad %',
            'Out_Mue' => 'Otra Utilidad %',
            'Pre_Mue' => 'Precio',
            'Pr2_Mue' => 'Precio',
            'Im1_Mue' => 'Imágen 1',
            'Im2_Mue' => 'Imágen 2',
            'Im3_Mue' => 'Imágen 3',
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
            $res = Consultas::getCodigo($this->$attribute);
            if ($res > 0):
                $this->addError($attribute, 'El código ya existe');
            endif;
        endif;
    }

}

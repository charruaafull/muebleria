<?php

class frm_registro extends CFormModel
{

    public $username;
    public $name;
    public $surname;
    public $email;
    public $password;

    public function rules()
    {

        return array(
            array('username', 'required'),
            //array('username', 'validaUsuario'),
         //   array('username', 'encoding'),
            array('username', 'length', 'max' => 10),
            ///
            array('name', 'required'),
            ///
            array('surname', 'required'),
            ///
            array('email', 'required'),
            array('email', 'email'),
            //array('mail', 'validaMail'),
            array('email', 'length', 'max' => 40),
            ///
            array('password', 'length', 'max' => 10),
            array('password', 'length', 'min' => 6),
        );
    }

    public function attributeLabels()
    {
        return array(
            'username' => 'Usuario',
            'name' => 'Nombre',
            'surname' => 'Apellido',
            'email' => 'Email',
            'password' => 'Contraseña',
        );
    }




}

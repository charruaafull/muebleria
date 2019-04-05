<?php

class Login_Mdl extends CFormModel {

    public $username;
    public $password;
    private $_identity;
    private $rememberMe;

    public function rules() {

        return array(
            array('username', 'required'),
            array('username', 'length', 'max' => 15),
            array('password', 'required'),
            array('password', 'authenticate'),
        );
    }

    public function attributeLabels() {

        return array(
            'username' => 'Usuario',
            'password' => 'Contraseña',
        );
    }

    public function authenticate($attribute, $params) {

        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            if ($mensaje = $this->_identity->authenticate())
                $this->addError('username', $mensaje);
            $this->password = '';
        }
    }

    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }

}

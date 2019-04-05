<?php

class UserIdentity extends CUserIdentity
{

    public function authenticate()
    {
        $res = Consultas::getCuenta($this->username, $this->password);
        if ($res):
            Yii::app()->session['USU'] = $res;
            return $this->errorCode = self::ERROR_NONE;
        else:
            return 'El usuario y/o contraseña no son válidos.';
        endif;
    }

}

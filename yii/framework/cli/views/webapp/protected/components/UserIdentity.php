<?php

class UserIdentity extends CUserIdentity {

    public function authenticate() {
        if ($res = Usu_Tbl::get($this->username, $this->password)):

            Yii::app()->session['USU'] = $res;
            Yii::app()->session['PER'] = (trim($res[0]['Nom_Usu']) == 'borono') ? 2 : 1;

            //10/04/2017 RJJ Si se desea que las claves expiren segun la fecha descomentar las lineas:
            //if ($res['USU_FEX'] == 0 or $res['USU_FEX'] >= date('Ymd')):
//            Adus_Tbl_Asysusua::set_ingreso(Yii::app()->session['usuario']['USU_IDE']);
//            Adus_Tbl_Asylog::set_log('LGIN');

            return $this->errorCode = self::ERROR_NONE;
//            else:
//
//                Adus_Tbl_Asylog::set_log('PWEX');
//                return 'Su contrase�a ha expirado.';
//            endif;

        else:
            return 'El usuario y/o contrase�a no son v�lidos.';

        endif;
    }

}

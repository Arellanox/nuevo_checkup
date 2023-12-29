<?php
include "../clases/correo_class.php";

class CorreoBot extends Correo
{
    private $data;
    function CorreoBot($data = array())
    {
        $this->data = $data;
    }

    function MandarCorreo(){
        $correosDestino = [
            // 'hola@bimo.com.mx',
            // 'isabella.leon@bimo.com.mx'
            'angelpjmy10@gmail.com'
        ];

        parent::sendEmail('botOrdenMedica','Cliente en espera',$correosDestino, $this->data, null, 0, null, null);
    }
}

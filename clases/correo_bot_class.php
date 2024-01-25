<?php
include "correo_class_copy.php";

class CorreoBot
{
    private $data;
    public $correoObj;
    function CorreoBot($data = array())
    {
        $this->data = $data;
        $this->correoObj = new Correo();
    }

    function MandarCorreo(){
        $correosDestino = [
            // 'hola@bimo.com.mx',
            // 'isabella.leon@bimo.com.mx'
            'angelpjmy10@gmail.com'
        ];
        return $this->correoObj->sendEmail('botOrdenMedica',"Cliente en espera!",$correosDestino, $this->data);
       # return parent::sendEmail('botOrdenMedica','Cliente en espera',$correosDestino, $this->data);
    }
}

<?php

class Url{
    public $urlServer;
    public $urlLocal;
    public $urlOrdenesMedicas;
    public $urlIdentificaciones;

    function Url(){
        $this->urlServer = "https://bimo-lab.com/";
        $this->urlLocal = "http://localhost/";
        $this->urlOrdenesMedicas = "archivos/ordenes_medicas/";
        $this->urlIdentificaciones = "archivos/identificacion/";
    }
}
?>
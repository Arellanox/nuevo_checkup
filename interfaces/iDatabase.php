<?php

interface iDatabase{
    #$nombres, es la lista de nombres de los sp y funciones que se encuentras en la $conexion.
    # $archivoSalida, es donde se guardaran las definiciones que el metodo genera.
    public function guardarDefinicionesFunciones();
    public function guardarDefinicionesTablas();
}


?>
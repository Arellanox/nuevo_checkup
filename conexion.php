<?php
$conexion = new mysqli("localhost","root","bimo2022","checkup");

if($conexion->connect_errno){
    echo "La conexion falló. ".$conexion->connect_error;
}

$conexion->set_charset('utf8');
?>
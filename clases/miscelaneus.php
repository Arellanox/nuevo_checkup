<?php
include "../conexion.php";

class Miscelaneus{

    function getFormValues($values){
        $form = array();
        foreach($values as $clave=>$valor){
            $form[$clave] = $valor;
        }

        return $form;
    }

    function escaparDatos($datos){
        global $conexion;

        $array_escaped = array();

        foreach($datos as $dato){
            // if(!is_numeric($dato)){
            //     $array_escaped[] = $conexion->real_escape_string($dato);
            // }else{
            //     $array_escaped[] = $dato;
            // }
            $array_escaped[] = $conexion->real_escape_string($dato);
        }

        return $array_escaped;

    }
}
?>
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

    //$datos = datos a comprobar
    //$intergers = posiciones del arreglo $datos que deben ser enteros
    //$strings = posiciones del arreglo $datos que deben ser cadenas de texto
    //$doubles = posiciones del arreglo $datos que deben ser numeros con decimales
    function validarDatos($datos,$intergers,$strings,$doubles){
        $errors = array();

        foreach($datos as $dato){
            if(in_array($count,$intergers)){
                if(!is_numeric($dato)){
                    $errors[] = $count;
                }
            }

            if(in_array($count,$strings)){
                if(!is_string($dato)){
                    $errors[] = $count;
                }
            }

            if(in_array($count,$doubles)){
                if(!is_float($dato)){
                    $errors[] = $count;
                }
            }
            $count = $count + 1;
        }

        return $errors;
    }
}
?>
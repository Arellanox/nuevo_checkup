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

    function escaparDatos($datos,$conexion){
        //global $conexion;

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
    function validarDatos($datos,$intergers,$strings,$doubles,$nulls=array()){
        $errors = array();

        $count = 0;
        foreach($datos as $dato){
            if(in_array($count,$intergers)){
                // echo "este es el dato: ".$dato." esta en interger";
                // echo "<br>";
                if(!is_numeric($dato)){
                    if(in_array($count,$nulls)){
                        //si esta dentro de los nulls
                        // no es un error, por tanto no hace nada
                    }else{
                        $errors[] = $count;
                    }
                }
            }
    
            if(in_array($count,$strings)){
                // echo "este es el dato: ".$dato." esta en string";
                // echo "<br>";
                if(!is_string($dato)){
                    if(in_array($count,$nulls)){
                        //si esta dentro de los nulls
                        // no es un error, por tanto no hace nada
                    }else{
                        $errors[] = $count;
                    }
                }
            }
    
            if(in_array($count,$doubles)){
                // echo "este es el dato: ".$dato." esta en doubles";
                // echo "<br>";
                if(!is_float($dato)){
                    if(in_array($count,$nulls)){
                        //si esta dentro de los nulls
                        // no es un error, por tanto no hace nada
                    }else{
                        $errors[] = $count;
                    }
                }
            }
            
            $count = $count + 1;
        }

        return $errors;
    }


    function sayHello(){
        echo "Hello World!";
    }
}
?>
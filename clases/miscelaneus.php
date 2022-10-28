<?php
require_once('../php/phpqrcode/qrlib.php');

class Miscelaneus{

    function getFormValues($values){
        $form = array();

        foreach($values as $clave=>$valor){

            # Convierte el valor null tomado como string en un valor booleano
            if(is_string($valor)){
                if (strtoupper($valor)=="NULL") {

                    $form[] = null;

                } else {

                    $form[] = $valor;
                }
            }else {

                $form[] = $valor;
            }

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

    function splitArray($source,$split){
        $splitted = array();
        $counter = 0;
        $position = 0;
        $aux = 0;
        $position_split = 0;

        $splitted[$position] = array();

        foreach ($source as  $value) {

            if(isset($split[$position_split])){
                if(count($splitted[$position])<$split[$position_split]){
                    $splitted[$position][] = $source[$counter];
                } else {
                    $position_split = $position_split + 1;
                    if(isset($split[$position_split])){
                        $position = $position + 1;
                        $splitted[$position] = array();
                        $splitted[$position][] = $source[$counter];
                    } else {
                        $splitted[$position][] = $source[$counter];
                    }
                }
            } else {
                $splitted[$position][] = $source[$counter];
            }

            $counter = $counter +1;
        }

        return $splitted;
    }

    function initValueNull($values){
        $initedArray = array();

        foreach($values as $value){
            if(!isset($value)){
                $initedArray[] = null;
            } else {
                $initedArray[] = $value;
            }
        }

        return $initedArray;
    }

    function setLog($message,$sp){
        $file = "log.txt";
        $fp = fopen($file,'a');
        $log = date("d/m/y H:i:s")." ".$sp." ".$message."\n";
        fwrite($fp,$log);
        fclose($fp);
    }

    function returnApi($response){

        if (is_array($response) || is_numeric($response)) {
            $json = json_encode(
                array("response"=>array(
                    'code'=>1,
                    'data'=>$response
                ))
                );
        } else {
            $json = json_encode(
                array("response"=>array(
                    'code'=>2,
                    'msj'=>$response
                ))
                );
        }

        return $json;
    }

    function sayHello(){
        echo "Hello World!";
    }

    function generarQRURL($tipo, $codeContents, $nombre){
      # URL carpeta
      $tempDir = '../archivos/sistema/temp/qr/'.$tipo.'/';

      # Enviar la url o codigo necesario desde antes
      QRcode::png($codeContents, $tempDir.$nombre.'png', QR_ECLEVEL_M);

      # retorna la URL donde se ubica el archivo
      return $tempDir.$tempDir.$nombre.'png';
    }
}
?>

<?php
require_once('../php/phpqrcode/qrlib.php');
date_default_timezone_set('America/Mexico_City');

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

    function generarQRURL($tipo, $codeContents, $nombre, $frame = QR_ECLEVEL_M, $size = 3){
      # URL carpeta
      $tempDir = 'archivos/sistema/temp/qr/'.$tipo.'/';

      # Enviar la url o codigo necesario desde antes
      QRcode::png($codeContents, '../'.$tempDir.$nombre.'.png', $frame, $size, 2);

      # retorna la URL donde se ubica el archivo
      return 'http://localhost/nuevo_checkup/'.$tempDir.$nombre.'.png';
    }

    function guardarFiles($files,$posicion='default', $dir/*, $carpetas = ['temp/']*/, $nombre){
    
        $urlArray = array();
        if (!empty($files[$posicion]['name'])) {
            
            $next = 0;
            foreach ($files[$posicion]['name'] as $key => $value) {
                $extension = pathinfo($files[$posicion]['name'][$key], PATHINFO_EXTENSION);
                # obtenemos la ruta temporal del archivo
                $tmp_name = $files[$posicion]['tmp_name'][$key];

                # Nueva ubicacion del archivo.
                $ubicacion = $dir.$nombre."_$next.".$extension;

                #cambiamos de lugar el archivo
                try {
                    move_uploaded_file($tmp_name, $ubicacion);
                    $urlArray[] = array('url' => $ubicacion, 'tipo' => $extension);
                } catch (\Throwable $th) {
                    $this->setLog("No se movieron los archivos $th","{guardarfiles}");
                  return "Algunos archivos no se lograron mover, intentelo nuevamente.";
                    # si no se puede subir el archivo, desactivamos el resultado que se guardo en la base de datos
                    // $e = $master->deleteByProcedure('sp_resultados_reportes_e',[$response[0]['LAST_ID']]);
                }
                $next++;
            }
            return $urlArray;
        } else {
            $this->setLog("El archivo esta vacio, error al subir archivo.","[function guardarFiles][$posicion]");
            return array();
        }
    }

    function createDir($dir){
        if(!is_dir($dir)){
            # si no existe el directorio, intenta crearlo
            if(!mkdir($dir, 0777, true)){
                # si no puede ejecutar la linea del if, envia un mensaje de error al log
                $this->setLog("no pudo crear el directorio. $dir",$dir);
            } else {
                # si puede crearlo, enviar mensaje de exito [1]
                return 1;
            }
        } else {
            # si el directorio ya existe, envia codigo de exito [1]
            return 1;
        }
        # si no puede crearlo, envia mensaje de error [0]
        return 0;
    } //fin createDir

    // comprueba si un arreglo esta realmente vacio
    public function checkArray($array,$isFile = 0){
        $newArray = array();
        foreach($array as $key => $value){
            if(is_array($value)){
                $newArray[$key] = $this->checkArray($value);
            } else {
                if(!empty($value)){
                    $newArray[$key] = $value;
                }
            }
            
        }// fin del foreach

        if($isFile==1){
            $aux = array();
            foreach($newArray as $key => $value){
                if(count($value)>1){
                    $aux[$key] = $value;
                }
            } // fin foreach
            $newArray = $aux;
        }
        return $newArray;
    } // fin de checkArray
}
?>

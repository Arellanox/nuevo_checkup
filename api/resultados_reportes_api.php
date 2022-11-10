<?php 
include_once "../clases/master_class.php";

$master = new Master();
$api = $_POST['api'];

$id_turno = $_POST['id_turno'];
$id_servicio = $_POST['id_servicio'];
$ruta = $_POST['ruta'];
$comentario = $_POST['comentario'];
$tipo = $_POST['tipo'];

# NOTA. para subir los archivos se encuentra en servicios api case 10

switch ($api) {
    case 1:
        # recuperar todos los archivos de un turno
        $response = $master->getByProcedure('sp_resultados_reportes_b',[$id_turno,$id_servicio]);

        $turno_aux = 0;
        $servicio_aux = 0;

        if(is_array($response)){
            $newResponse = array();
           for ($i=0; $i < count($response)-1; $i++) { 
                $current = $response[$i];
                if($i == 0){
                    # si es la primera vuelta

                    # configurarmos los valores que compararemos posteriormente
                    $turno_aux = $current['ID_TURNO'];
                    $servicio_aux = $current['ID_SERVICIO'];

                    $newResponse[$turno_aux][$servicio_aux][] = array(
                        'RUTA' => $current['RUTA'],
                        'INTERPRETACION' => $current['INTERPRETACION'],
                        'COMENTARIO' => $current['COMENTARIO'],
                        'FECHA_RESULTADO' => $current['FECHA_RESULTADO']
                    );
                } else if($turno_aux == $current['ID_TURNO'] && $servicio_aux == $current['ID_SERVICIO']){
                    # si el turno y el servicios siguen siendo iguales
                    # significa que el servicio tiene mas de un archivo o mas de una imagen
                    # por lo tanto se guarda en la siguiente posicion del mismo array.
                    $newResponse[$turno_aux][$servicio_aux][] = array(
                        'RUTA' => $current['RUTA'],
                        'INTERPRETACION' => $current['INTERPRETACION'],
                        'COMENTARIO' => $current['COMENTARIO'],
                        'FECHA_RESULTADO' => $current['FECHA_RESULTADO']
                    );
                } else {
                    # si no cumple la condicion inmediata de arriba
                    # se tienen que configurar nuevamente las variables de 
                    # servicio y turno para crear el nuevo arreglo.
                    $turno_aux = $current['ID_TURNO'];
                    $servicio_aux = $current['ID_SERVICIO'];

                    $newResponse[$turno_aux][$servicio_aux][] = array(
                        'RUTA' => $current['RUTA'],
                        'INTERPRETACION' => $current['INTERPRETACION'],
                        'COMENTARIO' => $current['COMENTARIO'],
                        'FECHA_RESULTADO' => $current['FECHA_RESULTADO']
                    );
                }
           } # fin del for

           echo json_encode(array("response"=>array("code"=>1,"data"=>$newResponse)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        exit; #salimos del programa para enviar enviar 2 respuestas.
        break;
    
    default:
        echo "Api no reconocida.";
        exit;
        break;
}

echo $master->returnApi($response);
?>
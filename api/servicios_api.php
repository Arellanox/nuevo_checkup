<?php
#include "../interfaces/iMetodos.php";
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
   // $tokenVerification->logout();
    //exit;
}

$master = new Master();
$api = $_POST['api'];
$id_area = $_POST['id_area'];
$otros_servicios = $_POST['otros_servicios']; #activar con valor 1
$abreviatura = $_POST['abreviatura']; #activar con valor 1
$confirmar = $_POST['confirmar'];
$id_turno = $_POST['id_turno'];
$id_servicio = $_POST['id_servicio'];
$comentario = $_POST['comentario'];


# para buscar servicios con precios establecidos al cliente
$paquete_id = $_POST['paquete_id'];
$cliente_id = $_POST['cliente_id'];


// echo "api $api";
// print_r($_FILES);

switch ($api) {
    case 1:
        #insert
        $array_slice = array_slice($_POST, 0, 19);
        $values = $master->mis->getFormValues($array_slice);
        $response = $master->insertByProcedure("sp_servicios_g",$values);
        if (is_numeric($response)) {
            echo json_encode(array(
                'response'=> array(
                    'code'=> 1,
                    'lastId'=>$response
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;
    case 2:
        #getall

        $response = $master->getByProcedure('sp_servicios_b',array(null,0,$id_area,$otros_servicios,$abreviatura));

        if (is_array($response)) {
            $newResponse = array();
            // foreach($response as $test){
            //     $groups = $master->getByProcedure('sp_detalle_grupo_b',array(null,$test['ID_SERVICIO']));
            //
            //     if(count($groups)>0){
            //         $test['DETALLE_GRUPOS'] = $groups;
            //     } else {
            //         $test['DETALLE_GRUPOS'] = 'NO PERTENECE A NINGUN GRUPO';
            //     }
            //
            //     $newResponse[] = $test;
            // }

            echo json_encode($response);
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;
    case 3:
        #getbyid
        $id = $_POST['id'];
        $response = $master->getByProcedure('sp_servicios_b',array($id,null,$id_area,$otros_servicios,$abreviatura));
        if (is_array($response)) {
            echo json_encode(array(
                'response'=> array(
                    'code'=> 1,
                    'data'=>$response
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;

    case 4:
        #update
        $array_slice = array_slice($_POST, 0, 20);
        $values = $master->mis->getFormValues($array_slice);
        $response = $master->updateByProcedure('sp_servicios_g',$values);
        if (is_numeric($response)) {
            echo json_encode(array(
                'response'=> array(
                    'code'=> 1,
                    'affected'=>$response
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;
    case 5:
        #delete
        $response = $master->deleteByProcedure('sp_servicios_e',array($id));
        if (is_numeric($response)) {
            echo json_encode(array(
                'response'=> array(
                    'code'=> 1,
                    'affected'=>$response
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;
    case 6:
        #recuperar todos los hijos de un padre
        $padre = $master->mis->getFormValues(array_slice($_POST,0,1));
        $response = $master->getByProcedure('sp_servicios_b',array($id,$padre,$id_area,$otros_servicios,$abreviatura));

        if (is_array($response)) {
            echo json_encode(array(
                'response'=> array(
                    'code'=> 1,
                    'data'=>$response
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;
    case 7:
        #recuperar todos los servicicos que sean grupos
        $response = $master->getByProcedure('sp_servicios_b',array(null,1,$id_area,$otros_servicios,$abreviatura));

        if(is_array($response)){
            $newResponse = array();
            foreach ($response as $group) {
                $tests = $master->getByProcedure('sp_detalle_grupo_b',array($group['ID_SERVICIO'],null));
                if (sizeof($tests)>0) {
                    $group['DETALLE_ESTUDIOS'] = $tests;
                } else {
                    $group['DETALLE_ESTUDIOS'] = 'NO TIENE ESTUDIOS ASOCIADOS';
                }

                $newResponse[] = $group;
            }
            echo json_encode(array(
                'response'=>array(
                    'code'=>1,
                    'data'=>$newResponse
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>1,
                    'data'=>$response
                )
                ));
        }
        break;
    case 8:

        $response = $master->getByProcedure('sp_servicios_b',array(null,null,$id_area,$otros_servicios,$abreviatura));
        echo $master->mis->returnApi($response);
        break;

    case 9:
        # recuperar solo los servicios que sean grupos,
        # los estudios que no tengan hijos y
        # los estudios que pertenezcan a la lista de precios del cliente seleccionado
        $response = $master->getByProcedure('sp_servicios_padres_b',[$id_area,$paquete_id,$cliente_id]);
        echo $master->returnApi($response);
        break;
    case 10:
        #Cargar los resultados (reportes) de las distintas areas

        # carpeta de destino para los reportes
        $destination = "/archivos/reportes/";
        $destinatio_sql = "https://bimo-lab.com/nuevo_checkup";

        # Evita que los archivos se sobreescriban si se suben mas de uno.
        $next = 0;

        foreach ($_FILES as $key => $error) {
            print_r($error);
            #Si no existe error en la carga de archivos procedemos a moverlo
            # a la caperta de destino.
            if($error['error'] == 0){
                # obtenemos la ruta temporal del archivo
                ## $tmp_name = $_FILES['reportes']['tmp_name'][$key];
                $tmp_name = $error['tmp_name'];

                # conseguimos solo el nombre del archivo, no la ruta.
                ## $name = basename($_FILES['reportes']['name'][$key]);
                $name = basename($error['name']);

                # dividimos el nombre del archvivo original para obtener la extension.
                # la extension del archivo se encuentra el posicion 1 del arreglo $explode.
                $explode = explode(".",$name);

                switch (strtolower($explode[1])) {
                    case 'pdf':
                    case 'docx':
                    case 'xlsx':
                    case 'pptx':
                    case 'doc':
                        $tipo = 1; # identificacion que es un archivo.
                        break;
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'bmp':
                    case 'webp':
                        $tipo = 2; # identifica que es una imagen.
                        break;

                    default:
                        echo "Formato no reconocido.";
                        exit; # salimos de la ejecucion del programa.
                        break;
                }
                #insertamos el registro en la tabla paciente_detalle
                $response = $master->updateByProcedure('sp_resultados_reportes_g',[$id_turno,$id_servicio,"$destinatio_sql$destination/$id_turno"."_$next.".$explode[1],$comentario,$tipo]);

                if(is_numeric($response)){
                    #cambiamos de lugar el archivo
                    move_uploaded_file($tmp_name,"..$destination/$id_turno"."_$next.".$explode[1]);
                    echo $master->returnApi($response);
                } else {
                    echo $master->returnApi($response);
                }
            }
            $next++;
        }
        break;
    case 11:
        # recupera todos los servicios que suben reportes o imagenes como resultado
        # de un turno.
        $response = $master->getByProcedure('sp_detalle_turno_b',[$id_turno,$id_area]);
        echo $master->returnApi($response);
        break;

    default:
        echo "Api no reconocida.";
        break;
}

/*
switch ($api) {
    case 1:

        $response = $servicio->insert($new);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 2:
        $response = $servicio->getAll();

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 3:
        $response = $servicio->getById(1);
        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 4:
        $response = $servicio->update($values);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;

    case 5:
        $response = $servicio->delete(1);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;

    default:
        # code...
        break;
} */

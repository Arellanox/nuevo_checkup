<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    #$tokenVerification->logout();
    #exit;
}

#api
$api = $_POST['api'];

#buscar
$id = $_POST['id'];
$id_paciente = $_POST['id_paciente'];
$id_area = $_POST['id_area'];
$fecha_agenda = $_POST['fecha_busqueda'];
$confirmar = $_POST['confirmar'];

#subir resultaddos
$servicio_id = $_POST['servicio_id'];
$resultado = $_POST['resultado'];
$observaciones = $_POST['observacionesGrupos'];
$observacionesServicios = $_POST['observacionesServicios'];
$confirmado_por = $_SESSION['id'];

#insertar
$id_turno = $_POST['id_turno'];
$paciente_id = $_POST['paciente_id'];
$paquete_id = $_POST['paquete_id'];
$prefolio = $_POST['prefolio'];
$folio = $_POST['folio'];
$fecha_registro = $_POST['fecha_registro'];
$fecha_agenda = $_POST['fecha_agenda'];
$fecha_reagenda = $_POST['fecha_reagenda'];
$fecha_recepcion = $_POST['fecha_recepcion'];
$turno = $_POST['turno'];
$habilitado = $_POST['habilitado'];
$identificacion = $_POST['identificacion'];
$total = $_POST['total'];
$completado = $_POST['completado'];
$comentario_rechazo = $_POST['comentario_rechazo'];
$cliente_id = $_POST['cliente_id'];
$segmento_id = $_POST['segmento_id'];



$parametros = array(
    $id_turno,
    $paciente_id,
    $paquete_id,
    $prefolio,
    $folio,
    //$fecha_registro,
    $fecha_agenda,
    $fecha_reagenda,
    $fecha_recepcion,
    $turno,
    $habilitado,
    $identificacion,
    $total,
    $completado,
    $comentario_rechazo,
    $cliente_id,
    $segmento_id
);
$response = "";

$master = new Master();
switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_turnos_g", $parametros);
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure("sp_turnos_b", [$id,]);
        break;
    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_turnos_g", $parametros);
        break;
    case 4:
        # desactivar
        $response = $master->deleteByProcedure("sp_turnos_e", [$id]);
        break;

    case 5:
        # recuperar la lista de trabajo por area
        $area = $_POST['area_id'];
        $fecha = $_POST['fecha_busqueda'];
        $response = $master->getByProcedure('sp_lista_de_trabajo', array($fecha, $area));
        break;
    case 10:
        #historial de servicios
        $response = $master->getByProcedure("sp_historial_servicios_paciente", [$id, $id_paciente, $id_area, $fecha_agenda]);
        break;

    case 7:
        # api falsa
        // print_r($_POST);
        echo json_encode(array("response" => array("code" => 1, "data" => array())));
        exit;
        break;

    case 8:
        # cargar los resultados
        $tipo = $_POST['tipo'];
        
        if($tipo==1){
            $grupos = $master->getByProcedure("sp_cargar_grupos", [$id_turno,$id_area]);     
            $response = $master->getByProcedure('sp_cargar_estudios',[$id_turno,$id_area]);
            $array = array();
            for($i=0; $i<count($grupos);$i++){
                $nombre_grupo = $grupos[$i]['GRUPO'];
                $id_grupo = $grupos[$i]['GRUPO_ID'];
                $obs = $grupos[$i]['OBSERVACIONES'];
                $contenido_grupo = array_filter($response, function ($obj) use ($nombre_grupo) {
                    $r = $obj["GRUPO"] == $nombre_grupo;
                    return $r;
                });
                $contenido_grupo['NombreGrupo'] = $nombre_grupo;
                $contenido_grupo['ID_GRUPO'] = $id_grupo;
                $contenido_grupo['OBSERVACIONES'] = $obs;
                if(!empty($contenido_grupo)){
                    $array[] = $contenido_grupo;
                }
            }

            echo json_encode(array("response"=>array("code"=>1,"data"=>$array)));
            exit;

        } else {
        $response = $master->getByProcedure('sp_cargar_estudios',[$id_turno,$id_area]);
        }

        break;

    case 9:
        # subir resultados
        $setResultados = $_POST['servicios'];
        $id_turno = $_POST['id_turno'];
        
        foreach ($setResultados as $servicio_id => $resultado) {
            #determinamos si el estudio de laboratorio tiene valor absoluto.
            $valor_absoluto = isset($resultado['VALOR']) ? $resultado['VALOR'] : NULL;

            #$a = array($id_turno, $servicio_id, $resultado, $confirmar, $confirmado_por, $valor_absoluto);
            $response = $master->updateByProcedure('sp_subir_resultados', array($id_turno, $servicio_id, $resultado['RESULTADO'],$confirmar,$confirmado_por,$valor_absoluto));
        }

        // actualizamos las observaciones por los grupos en casa hijo de la tabla paciente detalle
        
        foreach($observaciones as $key =>$observacion){
            $response = $master->updateByProcedure('sp_cargar_observaciones_laboratorio',[$id_turno,$key,null,$observacion]);
        }

        foreach($observacionesServicios as $key => $observacion){
            $response = $master->updateByProcedure('sp_cargar_observaciones_laboratorio',[$id_turno,null,$key,$observacion]);
        }
        //echo json_encode(array("response" => array("code" => 1, "msj" => "Termina la carga de datos.")));
        
        break;

    case 6:
        #servicios por turno
        $response = $master->getByProcedure('sp_turnos_historial', [$id, $id_paciente]);
        $hijo = $master->getByProcedure('sp_turnos_historial_detalle', [$id, $id_paciente, $id_area]);
        for ($i = 0; $i < count($response) ; $i++) {
            $id_turno_padre = $response[$i]['ID_TURNO'];
            $servicios = array_filter($hijo, function ($obj) use ($id_turno_padre) {
                $r = $obj['ID_TURNO'] == $id_turno_padre;
                return $r;
            });
            $response[$i]['servicios'] = $servicios;
        }
        break;

    case 11:

        break;

    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);

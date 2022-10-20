<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
   // $tokenVerification->logout();
   // exit;
}

#api
$api = $_POST['api'];

#buscar
$id = $_POST['id'];
$id_paciente = $_POST['id_paciente'];
$id_area = $_POST['id_area'];
$fecha_agenda = $_POST['fecha_busqueda'];

#subir resultaddos
$servicio_id = $_POST['servicio_id'];
$resultado = $_POST['resultado'];
$observaciones = $_POST['observaciones'];

#insertar
$id_turno = $_POST['id_turno'];
$paciente_id = $_POST['paciente_id'];
$paquete_id = $_POST['paquete_id'];
$prefolio = $_POST['prefolio'];
$folio = $_POST['folio'];
$fecha_registro = $_POST['fecha_registro'];
$fecha_agenda = $_POST['fecha_agenda'];
$fecha_recepcion = $_POST['fecha_recepcion'];
$turno = $_POST['turno'];
$habilitado = $_POST['habilitado'];
$identificacion = $_POST['identificacion'];
$total = $_POST['total'];
$completado = $_POST['completado'];


$parametros = array(
    $id_turno,
    $paciente_id,
    $paquete_id,
    $prefolio,
    $folio,
    $fecha_registro,
    $fecha_agenda,
    $fecha_recepcion,
    $turno,
    $habilitado,
    $identificacion,
    $total,
    $completado
);
$response="";

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
        $response = $master->getByProcedure('sp_lista_de_trabajo',array($fecha,$area));
        break;
    case 6:
        #historial de servicios
        $response = $master->getByProcedure("sp_historial_servicios_paciente", [$id,$id_paciente,$id_area,$fecha_agenda]);
        break;

    case 7:
        # api falsa
        echo json_encode(array("response"=>array("code"=>1,"data"=>array())));
        exit;
        break;

    case 8:
        # cargar los resultados
        $response = $master->getByProcedure('sp_cargar_estudios',[$id_turno,$id_area]);
        break;

    case 9:
        # subir resultados
        $setResultados = $_POST;
        $id_turno = array_slice($setResultados,count($setResultados)-3,1);
        //print_r($id_turno);
        foreach ($setResultados as $servicio_id => $resultado) {
            # code...
            $response = $master->updateByProcedure('sp_subir_resultados',array($id_turno['id_turno'],$servicio_id,$resultado,$observaciones));
            //print_r($response);
        }
        echo json_encode(array("response"=>array("code"=>1,"msj"=>"Termina la carga de datos.")));
        exit;
        //$response = $master->updateByProcedure('sp_subir_resultados',array($id_turno,$servicio_id,$resultado,$observaciones));
        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);

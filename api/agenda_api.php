<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];
$id_agenda = $_POST['id_agenda'];
$paciente = $_POST['id_paciente'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['numero'];
$fecha_agenda = $_POST['date'];
$area_id = $_POST['area_id'];
$registrado_por = $_SESSION['id'];
$observaciones = $_POST['observaciones'];
$detalle_servicios = $_POST['servicios'];
$hora_agenda = $_POST['hora_agenda']; # este es un id que viene de la tabla agenda horarios
$paquete_id = $_POST['paquete_id'];

#horarios

#configurar horarios de atencion.
$hora_inicial = $_POST['hora_cita'];

$hora_primera = $_POST['hora_inicial'];
$hora_final = $_POST['hora_final'];
$intervalo = $_POST['intervalo']; # debe llegar en minutos y debe ser un numero entero.


$params = $master->setToNull([
    $paciente,
    $nombre,
    $apellidos,
    $telefono,
    $fecha_agenda,
    $area_id,
    $registrado_por,
    $observaciones,
    json_encode(explode(",", $detalle_servicios)),
    $hora_agenda,
    $paquete_id
]);

switch ($api) {
    case 1:
        # agregar una agenda
        if (isset($_SESSION['id'])) {
            $master->setLog(json_encode($params), 'Parametros: ');
            $result = $master->getByNext("sp_agenda_g", $params);
            
            $response = [];
            foreach($result as $item){
                $response[] = codeAgenda($item[0]);
            }
        } else {
            $response = "Sesión caducada, por favor vuelva a iniciar sesión para continuar.";
        }
        break;
    case 2:
        # buscar los horarios disponibles de un area.
        $response = $master->getByProcedure("sp_agenda_horarios_b2", [$area_id, $fecha_agenda]);
        break;
    case 3:
        #buscar agendas
        $response = $master->getByProcedure("sp_agenda_b", [$area_id, $fecha_agenda]);

        for ($i = 0; $i < count($response); $i++) {
            $response[$i]["DETALLE_AGENDA"] = $master->decodeJson([$response[$i]["DETALLE_AGENDA"]]);
        }
        break;
    case 4:
        # eliminar una agenda
        $response = $master->deleteByProcedure("sp_agenda_e", [$id_agenda]);
        break;
    case 5:
        # agregar una horario a un area

        # crear los horarios de atencion dados la hora inical, hora final y el intervalo.
        $horarios = crearHorarios($hora_primera, $hora_final, $intervalo);

        if (is_array($horarios)) {
            $response = $master->insertByProcedure("sp_agenda_horarios_g", [null, json_encode($horarios), $area_id]);
        } else {
            $response = $horarios;
        }
        break;
    case 6:
        # eliminar horarios de un area
        $response = $master->deleteByProcedure("sp_agenda_horarios_e", [$hora_inicial, $area_id]);
        break;
    case 7:
        # buscar el horario configurado por el usuario.
        $result = $master->getByProcedure("sp_agenda_horario_get", [$area_id]);

        # enviamos solo el inicial y el final 
        $response = [];

        $response["HORA_INICIAL"] = $result[array_key_first($result)]['HORA_INICIAL'];
        $response["HORA_FINAL"] = $result[array_key_last($result)]['HORA_INICIAL'];
        $response["INTERVALO"] = $result[0]['INTERVALO'];
        break;
    default:
        break;
}

echo $master->returnApi($response);

function crearHorarios($inicial, $final, $intervalo)
{
    # verificvar si el $intervalo es un valor entero.
    if (!is_numeric($intervalo)) {
        return "El intervalo debe ser un valor númerico. Valor enviado: $intervalo";
    }

    $horarios = [];
    $current = strtotime($inicial);

    while ($current <= strtotime($final)) {
        $horarios[] = date('H:i', $current);
        $current = strtotime("+$intervalo minutes", $current);
    }

    return $horarios;
}

function codeAgenda($cadena){

    if (strpos($cadena, '@') === 0) {
        // La cadena tiene un "@" al principio
       return array("code"=> 2, "data" => substr($cadena, 1)); // Quitar el "@" al principio
    } else {
        return array("code"=> 1, "data" => $cadena);
    }
    
    
}



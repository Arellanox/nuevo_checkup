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
    $hora_agenda
]);

switch ($api) {
    case 1:
        # agregar una agenda
        $response = $master->insertByProcedure("sp_agenda_g", $params);
        break;
    case 2:
        # buscar los horarios disponibles de un area.
        $response = $master->getByProcedure("sp_agenda_horarios_b", [$area_id, $fecha_agenda]);
        break;
    case 3:
        #buscar agendas
        break;
    case 4:
        # eliminar una agenda
        break;
    case 5:
        # agregar una horario a un area
        break;
    case 6:
        # eliminar horarios de un area
        break;
    default:
        break;
}

echo json_encode($response);

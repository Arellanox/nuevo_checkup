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
$telefono = $_POST['telefono'];
$fecha_agenda = $_POST['fecha_agenda'];
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
    json_encode($detalle_servicios),
    $hora_agenda
]);

switch($api){
    case 1:
        $response = $master->insertByProcedure("sp_agenda", $params);
        break;

    default:
        break;
    case 2:
        $response = $master->getByProcedure("sp_agenda_horarios_b",[$area_id, $fecha_agenda]);
        break;
}

echo json_encode($response);

?>
<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

#api
$api = $_POST['api'];

#buscar
$id_turno = $_POST['id_turno'];
$id_paciente = $_POST['id_paciente'];
$id_area = $_POST['id_area'];
$fecha_agenda = $_POST['fecha_agenda'];
$fecha_agenda_final = $_POST['fecha_agenda_final'];
$con_paquete = $_POST['con_paquete'];
$franquiciaID = $_SESSION['franquiciario'] ? $_SESSION['id_cliente'] : null;

$response = "";

$master = new Master();
switch ($api) {
    case 1:
            $response = $master->getByProcedure("sp_toma_de_muestra_lista_de_trabajo", [
                $fecha_agenda, $fecha_agenda_final, $id_area, $con_paquete, $franquiciaID
            ]);
        break;
    case 2:
        # buscar_servicios de toma de muestra
        $response = $master->getByProcedure("sp_toma_de_muestra_servicios_b", [$id_paciente, 6, $id_turno]);
        break;
    case 3:
        # actualizar toma de muestra
        # indicar que la muestra ya ha sido tomada.
        if ($_SESSION['franquiciario']) {
            $response = $master->getByProcedure('sp_maquilas_altas_pacientes_a', [
                date('Y-m-d H:i:s'), $id_turno, $_SESSION['id']
            ]);
        }

        $response = $master->updateByProcedure("sp_toma_de_muestra_servicios_g", [$id_turno]);
        $_SESSION['turnero'] = null;
        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);

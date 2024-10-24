<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];

$turno_id = $_POST['turno_id'];
$religion = $_POST['religion'];
$lugar_nacimiento = $_POST['lugar_nacimiento'];
$estado_civil = $_POST['estado_civil'];
$telefono_paciente = $_POST['telefono_paciente'];
$puesto_solicita = $_POST['puesto_solicita'];
$depto = $_POST['depto'];
$no_imss = $_POST['no_imss'];
$profesion = $_POST['profesion'];
$escolaridad = $_POST['escolaridad'];
$umf = $_POST['umf'];
#contacto de emergencia
$nombre_contacto = $_POST['nombre_contacto'];
$parentesco = $_POST['parentesco'];
$tel1 = $_POST['tel1'];
$tel2 = $_POST['tel2'];

#busqueda
$fecha_admision = $_POST['fecha_admision'];

switch($api){
    case 1:
        # agregar/editar ficha de admision
        $response = $master->insertByProcedure("sp_sigma_ficha_admision_g", [
            $turno_id,
            $religion,
            $lugar_nacimiento,
            $estado_civil,
            $telefono_paciente,
            $puesto_solicita,
            $depto,
            $no_imss,
            $profesion,
            $escolaridad,
            $umf,
            $nombre_contacto,
            $parentesco,
            $tel1,
            $tel2
        ]);
        break;
    case 2:
        #buscar fichas
        $response = $master->getByProcedure('sp_sigma_ficha_admision_b', [$turno_id, $fecha_admision, $umf]);
        break;
    case 3:
        # eliminar ficha de admision
        $response = $master->deleteByProcedure('sp_sigma_ficha_admision_e', [$turno_id]);
        break;
    default:
        break;
}

echo $master->returnApi($response);
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
$id_paciente = $_POST['id_paciente'];

#insertar   
$id_consulta = $_POST['id_consulta'];
$turno_id = $_POST['turno_id'];
$fecha_consulta = $_POST['fecha_consulta'];
$motivo_consulta = $_POST['motivo_consulta'];
$notas_padecimiento = $_POST['notas_padecimiento'];
$consulta_subsecuente = $_POST['consulta_subsecuente'];
$diagnostico = $_POST['diagnostico'];


$parametros = array(
    $id_consulta,
    $turno_id,
    $fecha_consulta,
    $motivo_consulta,
    $notas_padecimiento,
    $consulta_subsecuente,
    $diagnostico
);
 
$response="";

$master = new Master();
switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_consultorio_consulta_g", $parametros);
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure("sp_consultorio_consulta_b", [$id_consulta,$turno_id,$id_paciente]);
        break;
    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_consultorio_consulta_g", $parametros);
        break;
    case 4:
        # desactivar
        $response = $master->deleteByProcedure("sp_consultorio_consulta_e", [$id_consulta]);
        break;

    default:
    $response = "api no reconocida";
        break;
}
echo $master->returnApi($response);
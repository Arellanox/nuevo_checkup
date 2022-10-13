<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/segmentos_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

#api
$api = $_POST['api'];

#buscar
$id = $_POST['id'];
$curp = $_POST['curp'];

#insertar
$id_paciente = $_POST['id'];
$segmento_id = $_POST['segmento'];
$nombre = $_POST['nombre'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$edad = $_POST['edad'];
$nacimiento = $_POST['nacimiento'];
$curp = $_POST['curp'];
$celular = $_POST['celular'];
$correo = $_POST['correo'];
$postal = $_POST['postal'];
$estado = $_POST['estado'];
$municipio = $_POST['municipio'];
$colonia = $_POST['colonia'];
$exterior = $_POST['exterior'];
$interior = $_POST['interior'];
$calle = $_POST['calle'];
$nacionalidad = $_POST['nacionalidad'];
$pasaporte = $_POST['pasaporte'];
$rfc = $_POST['rfc'];
$vacuna = $_POST['vacuna'];
$otravacuna = $_POST['vacunaExtra'];
$dosis = $_POST['inputDosis'];
$genero = $_POST['genero'];

$parametros = array(
    $id_paciente,
    $segmento_id,
    $nombre,
    $paterno,
    $materno,
    $edad,
    $nacimiento,
    $curp,
    $celular,
    $correo,
    $postal,
    $estado,
    $municipio,
    $colonia,
    $exterior,
    $interior,
    $calle,
    $nacionalidad,
    $pasaporte,
    $rfc,
    $vacuna,
    $otravacuna,
    $dosis,
    $genero
);
$master = new Master();
switch ($api) {
    case 1:
        # insertar un nuevo paciente
        $response = $master->insertByProcedure("sp_pacientes_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 2:
        # buscar pacientes
        $resultset = $master->getByProcedure("sp_pacientes_b", [$id, $curp]);
        if (is_array($resultset)) {
            echo json_encode($resultset);
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;

    case 3:
        # actualizar pacientes
        $response = $master->updateByProcedure("sp_pacientes_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response, "msj" => "Envío exitoso")));
        } else {
            echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => $response)));
        }
        break;
    case 4:
        # desactivr paciente

        $result = $master->deleteByProcedure("sp_pacientes_e", [$id]);
        if (is_numeric($result)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $result)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $result)));
        }
        break;
    // case -1:
    //     echo json_encode(array("response" => array("code" => 1, "affected" => $_POST)));
    //     break;
    default:
        echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => "api no reconocida")));
        break;
}

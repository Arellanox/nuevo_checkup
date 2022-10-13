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
$id = $_POST['id']; 

#insertar
$id_equipo = $_POST['id_equipo'];
$cve_inventario = $_POST['cve_inventario'];
$uso = $_POST['uso'];
$numero_serie = $_POST['numero_serie'];
$frecuencia_mantenimiento = $_POST['frecuencia_mantenimiento'];
$numero_pruebas = $_POST['numero_pruebas'];
$calibracion = $_POST['calibracion'];
$numero_pruebas_calibracion = $_POST['numero_pruebas_calibracion'];
$fecha_ingreso_equipo = $_POST['fecha_ingreso_equipo'];
$fecha_inicio_uso = $_POST['fecha_inicio_uso'];
$valor_del_equipo = $_POST['valor_del_equipo'];
$descripcion = $_POST['descripcion'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$foto = $_POST['foto'];
$status = $_POST['status'];

$parametros = array(
    $id_equipo,
    $cve_inventario,
    $uso,
    $numero_serie,
    $frecuencia_mantenimiento,
    $numero_pruebas,
    $calibracion,
    $numero_pruebas_calibracion,
    $fecha_ingreso_equipo,
    $fecha_inicio_uso,
    $valor_del_equipo,
    $descripcion,
    $marca,
    $modelo,
    $foto,
    $status
);
$master = new Master();
switch ($api) {
    case 1:
        # insertar
        $response = $master->insertByProcedure("sp_laboratorio_equipos_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 2:
        # buscar
        $resultset = $master->getByProcedure("sp_laboratorio_equipos_b", [$id]);
        if (is_array($resultset)) {
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;

    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_laboratorio_equipos_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response, "msj" => "Envío exitoso")));
        } else {
            echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => $response)));
        }
        break;
    case 4:
        # desactivar

        $result = $master->deleteByProcedure("sp_laboratorio_equipos_e", [$id]);
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

<?php
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$master = new Master();
$api = $_POST['api'];
$id_laboratorio_maquila = $_POST['LABORATORIO_MAQUILA_ID'];
$turno_id = $_POST['TURNO_ID'];
$servicio_id = $_POST['SERVICIO_ID'];
$usuario_id = $_SESSION['id'];
$id_maquila = $_POST['ID_MAQUILA']; // ESTATUS => NULL: PENDIENTE, 1: APROBADO, 2: RECHAZADO
$maquila_estatus = $_POST['MAQUILA_ESTATUS']; // 0: INACTIVO, 1: ACTIVO, 2: OCULTO, 3: ELIMINADO
$activo = $_POST['ACTIVO'];
$mostrar_ocultos = $_POST['MOSTRAR_OCULTOS'];

switch ($api) {
    case 1:
        $response = $master->insertByProcedure('sp_laboratorio_estudios_maquila_g', [
            $turno_id, $servicio_id, $id_laboratorio_maquila, $usuario_id
        ]);
        break;
    case 2: // Recuperar información del estudio pendiente a maquilar
        $response = $master->getByProcedure('sp_laboratorio_estudios_maquila_b', [
            $id_maquila, $mostrar_ocultos, null, null
        ]);
        break;
    case 3: // Actualizar campo "activo" del estudio a maquilar
        $ids = is_array($id_maquila) ? implode(',', $id_maquila) : $id_maquila;

        $response = $master->updateByProcedure('sp_laboratorio_estudios_maquila_a', [
            $ids, $maquila_estatus
        ]);
        break;
    case 4: // Eliminar estudio a maquilar
        $response = $master->deleteByProcedure('sp_laboratorio_estudios_maquila_e', [
            $id_maquila
        ]);
        break;
    case 5: // Generer reporte de estudios a maquilar
        $url = $master->reportador($master, $turno_id, -8, 'maquilas');
        $response = ['url' => $url];
        break;
    default:
        $response = "API no definida";;
        break;
}

echo $master->returnApi($response);